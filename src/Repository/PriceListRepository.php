<?php

declare(strict_types=1);

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
        ->select('p.price')
        ->andWhere('p.SKU = :sku')
        ->setParameter('sku', $SKU)
        ->getQuery()->getSingleColumnResult();
    }

    public function deleteBySKU(int $SKU): bool
    {
        return $this->createQueryBuilder('p')
        ->delete()
        ->andWhere('p.SKU = :sku')
        ->setParameter('sku', $SKU)
        ->getQuery()
        ->execute();
    }
}
