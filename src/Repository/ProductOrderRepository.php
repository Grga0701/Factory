<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\ProductOrder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProductOrder>
 */
class ProductOrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductOrder::class);
    }

    public function getProductsByOrderId(int $orderId): array
    {
        return $this->createQueryBuilder('p')
        ->andWhere('p.orderId = :id')
        ->setParameter('id', $orderId)
        ->getQuery()->getScalarResult();
    }

    public function deleteByOrderId(int $orderId) : bool 
    {
        return $this->createQueryBuilder('o')
        ->delete()
        ->andWhere('o.orderId = :id')
        ->setParameter('id', $orderId)
        ->getQuery()
        ->execute();
    }
}
