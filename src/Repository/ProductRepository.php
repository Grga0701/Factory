<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }


    public function findById(int $productId): array
    {
        return $this->createQueryBuilder('p')
        ->andWhere('p.id = :id')
        ->setParameter('id', $productId)
        ->getQuery()
        ->getScalarResult();
    }

    public function deleteById(int $productId): bool
    {
        return $this->createQueryBuilder('p')
        ->delete()
        ->andWhere('p.id = :id')
        ->setParameter('id', $productId)
        ->getQuery()
        ->execute();
    }
    
    public function getAllProducts(): array
    {
        return $this->createQueryBuilder('p')
        ->getQuery()->getScalarResult();
    }
}