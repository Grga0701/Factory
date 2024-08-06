<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Category>
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }
    public function save(Category $category): bool
    {
        ##query 
        return true;
    }

    public function findById(int $categoryId): array
    {
        ##query
        return [];
    }

    public function getAllCategories(): array
    {
        ##query 
        return [];
    }

    public function deleteById(int $categoryId): bool
    {
        ##query 
        return true;
    }
}
