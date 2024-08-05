<?php

namespace App\Application;

use App\Entity\Product;

interface ProductServiceInterface
{
    public function createProduct(array $data): int;

    public function getProductById(int $productId): array;

    public function getAllProducts(): array;

    public function deleteProduct(int $productId, int $SKU): bool;
}
