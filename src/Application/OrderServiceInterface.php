<?php

declare(strict_types=1);

namespace App\Application;

use App\Entity\Order;

interface OrderServiceInterface
{
    public function createOrder(array $data): bool;

    public function getOrderById(int $orderId): array;

    public function getAllOrders(): array;

    public function deleteOrder(int $orderId): bool;
}
