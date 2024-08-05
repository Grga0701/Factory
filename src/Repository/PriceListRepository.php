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

    public function findBySKU(int $SKU): array
    {
        return $this->createQueryBuilder('p')
        ->andWhere('p.sku = :sku')
        ->setParameter('sku', $SKU)
        ->getQuery()
        ->getScalarResult();
    }

    public function deleteBySKU(int $SKU): bool
    {
        return $this->createQueryBuilder('p')
        ->delete()
        ->andWhere('u.sku = :sku')
        ->setParameter('sku', $SKU)
        ->getQuery()
        ->execute();
    }
}
