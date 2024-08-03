<?php

namespace App\Application;

use App\Entity\Product;

interface ProductServiceInterface
{
    public function createProduct(array $data): bool;

    public function getProductById(int $productId): Product;

    public function getAllProducts(): array;

    public function deleteProduct(int $productId): bool;
}
