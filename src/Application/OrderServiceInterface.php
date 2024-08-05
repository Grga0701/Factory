<?php

namespace App\Application;

use App\Entity\Order;

interface OrderServiceInterface
{
    public function createOrder(array $data): bool;

    public function getOrderById(int $orderID): Order;

    public function getAllOrders(): array;

    public function deleteOrder(int $orderId): bool;
}
