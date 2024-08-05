<?php

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

    public function save(array $data): bool
    {
        ##query
        $user = new User(
            $data['id'],
            $data['name'],
            $data['lastname'],
            $data['phone_number'],
            $data['date_of_birth'],
            $data['date_of_registration']
        );
        return true;
    }

    public function findById(int $userId): array
    {
        ##query
        return [];
    }

    public function getAllUsers(): array
    {
        $test = $this->createQueryBuilder('u')
        ->andWhere('u.name = :userName')
        ->setParameter('userName', 'Marko')
        ->getQuery()
        ->getResult();
        return [];
    }

    public function deleteById(int $userId): bool
    {
        ##query 
        return true;
    }
}
