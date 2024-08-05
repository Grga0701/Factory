<?php

namespace App\Application;

use App\Entity\PriceList;
use App\Entity\Product;
use App\Application\ProductServiceInterface;
use App\Repository\PriceListRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\DBAL\Exception as DBALException;

class ProductService implements ProductServiceInterface
{

    public function __construct(
        public ProductRepository $productRepository, 
        public EntityManagerInterface $entityManager,
        public PriceListRepository $priceListRepository, 
    )
    {
    }

    public function createProduct(array $data): int
    {
        $product = new Product($data['name'], $data['description'], $data['SKU'], $data['published'], $data['category']);
        $priceList = new PriceList();
        $priceList->setName($data['name']);
        $priceList->setPrice($data['price']);
        $priceList->setSKU($data['SKU']);

        try {
            $this->entityManager->persist($product);
            $this->entityManager->persist($priceList);
            $this->entityManager->flush();
            return JsonResponse::HTTP_CREATED;
        } catch (ORMException $e) {
            return JsonResponse::HTTP_INTERNAL_SERVER_ERROR;
        } catch (DBALException $e) {
            return JsonResponse::HTTP_INTERNAL_SERVER_ERROR;
        } catch (\Exception $e) {
            return JsonResponse::HTTP_INTERNAL_SERVER_ERROR;
        }
    }

    public function getProductById(int $productId): array
    {
        $product =  $this->productRepository->findById($productId);
        $priceList = $this->priceListRepository->findBySKU($product['SKU']);
        $product['price'] = $priceList['price'];
        return $product;
    }

    public function getAllProducts(): array
    {
        $productsWithPrice = [];
        foreach($this->productRepository->getAllProducts() as $product){
            $priceList = $this->priceListRepository->findBySKU($product['SKU']);
            $product['price'] = $priceList['price'];
            $productsWithPrice[]= $product;
        }
        return $productsWithPrice;
    }

    public function deleteProduct(int $productId, int $SKU): bool
    {
        return  ($this->productRepository->deleteById($productId) && $this->priceListRepository->deleteBySKU($SKU));
    }
}
