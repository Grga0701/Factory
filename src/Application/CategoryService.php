<?php

declare(strict_types=1);

namespace App\Application;

use App\Application\CategoryServiceInterface;
use App\Repository\CategoryRepository;

class CategoryService implements CategoryServiceInterface
{
    public function __construct(public CategoryRepository $categoryRepository)
    {
    }

    public function createCategory(array $data): bool
    {
        return true;
    }

    public function getCategoryById(int $categoryId): array
    {
        return [];
    }

    public function getAllCategories(): array
    {
        return [];
    }

    public function deleteCategory(int $categoryId): bool
    {
        return true;
    }
}
