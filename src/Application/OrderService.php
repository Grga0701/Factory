<?php

declare(strict_types=1);

namespace App\Application;

use App\Entity\Order;
use App\Application\OrderServiceInterface;
use App\Entity\ProductOrder;
use App\Repository\ContractListRepository;
use App\Repository\OrderRepository;
use App\Repository\PriceListRepository;
use App\Repository\ProductOrderRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use DateTime;

class OrderService implements OrderServiceInterface
{
    public const TAX = 25;
    public function __construct(
        public OrderRepository $orderRepository,
        public ProductOrderRepository $productOrderRepository,
        public ContractListRepository $contractListRepository,
        public ProductRepository $productRepository,
        public PriceListRepository $priceListRepository,
        public EntityManagerInterface $entityManager
    )
    {
    }

    public function createOrder(array $data): bool
    {
        $orderPrice = 0.0;
        $order = new Order($data['user_id'],$orderPrice,new DateTime($data['date'] ?? 'now'), $data["dynamic_fields"]);
        $this->entityManager->persist($order);
        $this->entityManager->flush();
        foreach ($data['products'] as $productId){
            $product = $this->productRepository->findById($productId);
            $priceList = $this->priceListRepository->findBySKU($product['p_SKU']);
            $price = $this->priceCalculator($order->getUserId(), $product['p_SKU'], $priceList[0]);
            $productOrder = new ProductOrder($order->getId(),$product['p_id'],$price,self::TAX);
            $this->entityManager->persist($productOrder);
            $orderPrice += $price;
        }
        $order->setPrice($orderPrice);
        $this->entityManager->flush();
        return true;
    }

    public function getOrderById(int $orderId): array
    {
        $order = $this->orderRepository->findById($orderId);
        $products = $this->productOrderRepository->getProductsByOrderId($order[0]['o_id']);
        $order['o_products'] = json_encode($products);

        return $order;
    }

    public function getAllOrders(): array
    {
        $ordersWithProducts = [];
        $orders =  $this->orderRepository->getAllOrders();
        foreach($orders as $order){
            $products = $this->productOrderRepository->getProductsByOrderId($order['o_id']);
            $order['o_products'] = json_encode($products);
            $ordersWithProducts[] = $order;
        }
        return $ordersWithProducts;
    }

    public function deleteOrder(int $orderId): bool
    {
        return  ($this->orderRepository->deleteById($orderId) && $this->productOrderRepository->deleteByOrderId($orderId));
    }

    private function priceCalculator(int $userId, int $SKU, float $price): float
    {
        $contractList = $this->contractListRepository->getContractListByUserIdAndSKU(
            $userId,
            $SKU
        );
        $price = !empty($contractList[0]['c_price']) ? $contractList[0]['c_price'] : $price;
        if (!empty($contractList[0]['c_modificator'])){
            if($contractList[0]['c_modificator'] === 'special_price'){
                $price = $price - $contractList[0]['c_modificatorValue'];
            }else{
                $price = $price * $contractList[0]['c_modificatorValue'];
            }
        }
        return $price;
    }
}
