<?php

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


    public function getContractListByUserIdAndSKU(int $uderId, int $SKU): ?ContractList
    {
        return new ContractList(1,1,1,1,'',1);
    }

}
