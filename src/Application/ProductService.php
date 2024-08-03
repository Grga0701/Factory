<?php

namespace App\Application;

use App\Entity\Product;
use App\Application\ProductServiceInterface;
use App\Repository\ProductRepository;

class ProductService implements ProductServiceInterface
{

    public function __construct(public ProductRepository $productRepository)
    {
    }

    public function createProduct(array $data): bool
    {
        $product = new Product($data['name'], $data['description'], $data['price'], $data['SKU'], $data['published']);
        return $this->productRepository->save($product);
    }

    public function getProductById(int $productId): Product
    {
        $data = $this->productRepository->findById($productId);
        $product = new Product($data['name'], $data['description'], $data['price'], $data['SKU'], $data['published']);

        return $product;
    }

    public function getAllProducts(): array
    {
        return $this->productRepository->getAllProducts();
    }

    public function deleteProduct(int $productId): bool
    {
        return  $this->productRepository->deleteById($productId);
    }
}
