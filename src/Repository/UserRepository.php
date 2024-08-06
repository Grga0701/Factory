<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findById(int $userId): array
    {
        return $this->createQueryBuilder('u')
        ->andWhere('u.id = :userId')
        ->setParameter('userId', $userId)
        ->getQuery()
        ->getScalarResult();
    }

    public function getAllUsers(): array
    {
        return $this->createQueryBuilder('u')
        ->getQuery()->getScalarResult();
    }

    public function deleteById(int $userId): bool
    {
        return $this->createQueryBuilder('u')
        ->delete()
        ->andWhere('u.id = :id')
        ->setParameter('id', $userId)
        ->getQuery()
        ->execute();
    }
}
