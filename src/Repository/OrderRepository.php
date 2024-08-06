<?php

declare(strict_types=1);

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

    public function findById(int $id): array
    {
        return $this->createQueryBuilder('o')
        ->andWhere('o.id = :id')
        ->setParameter('id', $id)
        ->getQuery()->getScalarResult();
    }

    public function getAllOrders(): array
    {
        return $this->createQueryBuilder('o')
        ->getQuery()->getScalarResult();
    }

    public function getAllOrdersForAUser(int $userId): array
    {
        return $this->createQueryBuilder('o')
        ->andWhere('o.userId = :userId')
        ->setParameter('userId', $userId)
        ->getQuery()->getScalarResult();
    }

    public function deleteById(int $orderId): bool
    {
        return $this->createQueryBuilder('u')
        ->delete()
        ->andWhere('u.id = :id')
        ->setParameter('id', $orderId)
        ->getQuery()
        ->execute();
    }
}
