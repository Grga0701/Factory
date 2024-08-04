<?php

namespace App\Repository;

use App\Entity\Product;
use App\Entity\ProductOrder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Category>
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

    public function getProductById(int $productId): Product
    {
        ##query
        return new Product();
    }
    
    public function getAllProducts(): array
    {
        ##query 
        return [];
    }

    public function deleteById(int $productId): bool
    {
        ##query 
        return true;
    }

}