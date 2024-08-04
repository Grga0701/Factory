<?php

namespace App\Application;

use App\Entity\Category;
use App\Application\CategoryServiceInterface;
use App\Repository\CategoryRepository;

class CategoryService implements CategoryServiceInterface
{
    public function __construct(public CategoryRepository $categoryRepository)
    {
    }

    public function createCategory(array $data): bool
    {
        $category = new Category($data['name'], $data['description'], $data['price'], $data['SKU'], $data['published']);
        return $this->categoryRepository->save($category);
    }

    public function getCategoryById(int $categoryId): Category
    {
        $data = $this->categoryRepository->findById($categoryId);
        $category = new Category($data['name'], $data['description'], $data['price'], $data['SKU'], $data['published']);

        return $category;
    }

    public function getAllCategories(): array
    {
        return $this->categoryRepository->getAllCategories();
    }

    public function deleteCategory(int $categoryId): bool
    {
        return  $this->categoryRepository->deleteById($categoryId);
    }
}
