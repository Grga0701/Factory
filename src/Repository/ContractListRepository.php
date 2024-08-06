<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\ContractList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ContractList>
 */
class ContractListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContractList::class);
    }

    public function getContractListByUserIdAndSKU(int $userId, int $SKU): array
    {
        return $this->createQueryBuilder('c')
        ->andWhere('c.userId = :userId')
        ->andWhere('c.SKU = :sku')
        ->setParameter('userId', $userId)
        ->setParameter('sku', $SKU)
        ->getQuery()->getScalarResult();
    }

    public function getAllContractsForAUser(int $userId): array
    {
        return $this->createQueryBuilder('c')
        ->andWhere('c.userId = :userId')
        ->setParameter('userId', $userId)
        ->getQuery()->getScalarResult();
    }

    public function deleteById(int $contractListId): bool
    {
        return $this->createQueryBuilder('c')
        ->delete()
        ->andWhere('c.id = :id')
        ->setParameter('id', $contractListId)
        ->getQuery()
        ->execute();
    }
}