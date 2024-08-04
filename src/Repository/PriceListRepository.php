<?php

namespace App\Repository;

use App\Entity\PriceList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PriceList>
 */
class PriceListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PriceList::class);
    }

    public function save(PriceList $priceList): bool
    {
        ##query 
        return true;
    }

    public function findById(int $priceListId): array
    {
        ##query
        return [];
    }

    public function getAllPriceLists(): array
    {
        ##query 
        return [];
    }

    public function deleteById(int $priceListId): bool
    {
        ##query 
        return true;
    }
}
