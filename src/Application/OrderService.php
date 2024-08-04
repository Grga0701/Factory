<?php

namespace App\Application;

use App\Entity\ContractList;
use App\Entity\Order;
use App\Application\OrderServiceInterface;
use App\Entity\Product;
use App\Entity\ProductOrder;
use App\Repository\ContractListRepository;
use App\Repository\OrderRepository;
use App\Repository\PriceListRepository;
use App\Repository\ProductOrderRepository;
use App\Repository\ProductRepository;

class OrderService implements OrderServiceInterface
{
    public const TAX = 25;
    public function __construct(
        public OrderRepository $orderRepository,
        public ProductOrderRepository $productOrderRepository,
        public ContractListRepository $contractListRepository,
        public ProductRepository $productRepository,
        public PriceListRepository $priceListRepository
    )
    {
    }

    public function createOrder(array $data): bool
    {
        $orderPrice = null;
        $order = new Order($data['user_id'],$orderPrice, $data['date'], $data['dynamic_field']);
        foreach ($data['products'] as $productId){
            $product = $this->productRepository->getProductById($productId);
            $priceList = $this->priceListRepository->getPriceForAProduct($product->getSKU());
            $price = $this->priceCalculator($order->getUserId(), $product->getSKU(), $priceList);
            $productOrder = new ProductOrder($order->getId(),$product->getId(),$price,self::TAX);
            $this->productOrderRepository->save($productOrder);
            $orderPrice += $price;
        }
        $order->setPrice($orderPrice);
        return $this->orderRepository->save($order);
    }

    public function getOrderById(int $orderId): Order
    {
        $data = $this->orderRepository->findById($orderId);
        $order = new Order($data['user_id'], $data['price'], $data['date'], $data['dynamic_field']);

        return $order;
    }

    public function getAllOrders(): array
    {
        return $this->orderRepository->getAllOrders();
    }

    public function deleteOrder(int $orderId): bool
    {
        return  $this->orderRepository->deleteById($orderId);
    }

    public function priceCalculator(int $userId, int $SKU, float $price): float
    {
        $contractList = $this->contractListRepository->getContractListByUserIdAndSKU(
            $userId,
            $SKU
        );
        $price = !empty($contractList->getPrice()) ? $contractList->getPrice() : $price;
        if (!empty($contractList->getModificator())){
            $price = $price * $contractList->getModificatorValue();
        }
        return $price;
    }
}
