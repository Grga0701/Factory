<?php

namespace App\Application;

use App\Entity\Category;

interface CategoryServiceInterface
{
    public function createCategory(array $data): bool;

    public function getCategoryById(int $categoryId): Category;

    public function getAllCategories(): array;

    public function deleteCategory(int $categoryId): bool;
}
