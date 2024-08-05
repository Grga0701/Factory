<?php

use PHPUnit\Framework\TestCase;
use App\Application\OrderService;
use App\Entity\ContractList;
use App\Repository\OrderRepository;
use App\Repository\ProductOrderRepository;
use App\Repository\ContractListRepository;
use App\Repository\ProductRepository;
use App\Repository\PriceListRepository;
use App\Entity\Order;
use App\Entity\ProductOrder;
use App\Entity\Product;
use App\Entity\PriceList;

class OrderServiceTest extends TestCase
{
    private $orderRepository;
    private $productOrderRepository;
    private $contractListRepository;
    private $productRepository;
    private $priceListRepository;
    private $orderService;
    private $contractList;

    protected function setUp(): void
    {
        $this->orderRepository = $this->createMock(OrderRepository::class);
        $this->productOrderRepository = $this->createMock(ProductOrderRepository::class);
        $this->contractListRepository = $this->createMock(ContractListRepository::class);
        $this->productRepository = $this->createMock(ProductRepository::class);
        $this->priceListRepository = $this->createMock(PriceListRepository::class);
        $this->contractList = $this->createMock(ContractList::class);

        $this->orderService = new OrderService(
            $this->orderRepository,
            $this->productOrderRepository,
            $this->contractListRepository,
            $this->productRepository,
            $this->priceListRepository
        );
    }

    public function testCreateOrder(): void
    {
        $data = [
            'user_id' => 1,
            'date' => new \DateTime('2023-01-01'),
            'dynamic_fields' => 'some_value',
            'products' => [1, 2]
        ];

        $product1 = new Product(1, 'Product 1', 12345, 1);
        $product2 = new Product(2, 'Product 2', 67890, 1);

        $priceList1 = $this->createMock(PriceList::class);
        $priceList1->method('getPrice')->willReturn(100.0);

        $priceList2 = $this->createMock(PriceList::class);
        $priceList2->method('getPrice')->willReturn(200.0);

        $this->productRepository
            ->method('getProductById')
            ->willReturnOnConsecutiveCalls($product1, $product2);

        $this->priceListRepository
            ->method('getPriceForAProduct')
            ->willReturnOnConsecutiveCalls(100.0, 200.0);

        $this->contractListRepository
            ->method('getContractListByUserIdAndSKU')
            ->willReturn(new ContractList(1,1,100.0,12345,'',0));

        $this->contractList
            ->method('getPrice')
            ->willReturn(100.0);

        $this->productOrderRepository
            ->expects($this->exactly(2))
            ->method('save');

        $this->orderRepository
            ->expects($this->once())
            ->method('save')
            ->willReturn(true);

        $result = $this->orderService->createOrder($data);
        $this->assertTrue($result);
    }

    public function testGetOrderById(): void
    {
        $orderId = 1;
        $data = [
            'user_id' => 1,
            'price' => 300.0,
            'date' => new \DateTime('2023-01-01'),
            'dynamic_fields' => 'some_value'
        ];

        $this->orderRepository
            ->method('findById')
            ->with($orderId)
            ->willReturn($data);

        $order = $this->orderService->getOrderById($orderId);
        $this->assertInstanceOf(Order::class, $order);
        $this->assertEquals($data['user_id'], $order->getUserId());
        $this->assertEquals($data['price'], $order->getPrice());
        $this->assertEquals($data['date'], $order->getDate());
        $this->assertEquals($data['dynamic_fields'], $order->getDynamicFields());
    }

    public function testGetAllOrders(): void
    {
        $orders = [
            ['user_id' => 1, 'price' => 300.0, 'date' => new \DateTime('2023-01-01'), 'dynamic_fields' => 'value1'],
            ['user_id' => 2, 'price' => 400.0, 'date' => new \DateTime('2023-02-01'), 'dynamic_fields' => 'value2']
        ];

        $this->orderRepository
            ->method('getAllOrders')
            ->willReturn($orders);

        $result = $this->orderService->getAllOrders();
        $this->assertCount(2, $result);
        $this->assertEquals($orders, $result);
    }

    public function testDeleteOrder(): void
    {
        $orderId = 1;

        $this->orderRepository
            ->expects($this->once())
            ->method('deleteById')
            ->with($orderId)
            ->willReturn(true);

        $result = $this->orderService->deleteOrder($orderId);
        $this->assertTrue($result);
    }
}
