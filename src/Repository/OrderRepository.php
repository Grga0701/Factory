<?php

namespace App\Repository;

use App\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Order>
 */
class OrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    public function save(Order $order): bool
    {
        return true;
    }

    public function findById(int $userId): array
    {
        ##query
        return [];
    }

    public function getAllOrders(): array
    {
        ##query
        return [];
    }

    public function deleteById(int $userId): bool
    {
        ##query
        return true;
    }
}
