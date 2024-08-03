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

    public function save(Product $product): bool
    {
        ##query 
        return true;
    }

    public function findById(int $productId): array
    {
        ##query
        return [];
    }
    
    public function getAllProducts(): array
    {
        ##query 
        return [];
    }

    public function deleteProduct(int $productId): bool
    {
        ##query 
        return true;
    }

}