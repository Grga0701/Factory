<?php

namespace App\Application;

use App\Entity\PriceList;
use App\Application\PriceListServiceInterface;
use App\Repository\PriceListRepository;

class PriceListService implements PriceListServiceInterface
{

    public function __construct(public PriceListRepository $priceListRepository)
    {
    }

    public function createPriceList(array $data): bool
    {
        $priceList = new PriceList($data['name'], $data['description'], $data['price'], $data['SKU'], $data['published']);
        return $this->priceListRepository->save($priceList);
    }

    public function getPriceListById(int $priceListId): PriceList
    {
        $data = $this->priceListRepository->findById($priceListId);
        $priceList = new PriceList($data['name'], $data['description'], $data['price'], $data['SKU'], $data['published']);

        return $priceList;
    }

    public function getAllPriceLists(): array
    {
        return $this->priceListRepository->getAllPriceLists();
    }

    public function deletePriceList(int $priceListId): bool
    {
        return  $this->priceListRepository->deleteById($priceListId);
    }
}
