<?php

declare(strict_types=1);

namespace App\Application;

interface ProductServiceInterface
{
    public function createProduct(array $data): int;

    public function getProductById(int $productId): array;

    public function getAllProducts(): array;

    public function deleteProduct(int $productId, int $SKU): bool;
}
