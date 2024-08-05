<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Application\ProductService;

class ProductController extends AbstractController
{
    public function __construct(public ProductService $productService)
    {
    }

    #[Route('/product/get/all', name: 'get_all_products')]
    public function GetAllProducts(): JsonResponse
    {
        return new JsonResponse($this->productService->getAllProducts());
    }

    #[Route('/product/get/{id}', name: 'get_product_by_id')]
    public function GetProductsById(int $id): JsonResponse
    {
        return new JsonResponse($this->productService->getProductById($id));
    }

    #[Route('/product/create', name: 'save_new_product',  methods: ['POST'])]
    public function SaveProduct(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        return new JsonResponse($this->productService->createProduct($data));
    }

    #[Route('/product/delete', name: 'delete_product_by_id',  methods: ['POST'])]
    public function DeleteProductsById(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        return new JsonResponse($this->productService->deleteProduct($data['product_id'], $data['SKU']));
    }
}
