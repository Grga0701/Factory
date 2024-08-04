<?php

namespace App\Application;

use App\Entity\PriceList;

interface PriceLIstServiceInterface
{
    public function createPriceList(array $data): bool;

    public function getPriceListById(int $priceListId): PriceList;

    public function getAllPriceLists(): array;

    public function deletePriceList(int $priceListId): bool;
}
