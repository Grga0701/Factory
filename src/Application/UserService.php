<?php

namespace App\Application;

use App\Entity\User;
use App\Application\UserServiceInterface;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use DateTime;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\DBAL\Exception as DBALException;

class UserService implements UserServiceInterface
{

    public function __construct(public UserRepository $userRepository, public EntityManagerInterface $entityManager)
    {
    }

    public function createUser(array $data): int
    {
        $user = new User();
        $user->setName($data['name']);
        $user->setLastName($data['lastname']);
        $user->setPhoneNumber($data['phonenumber'] ?? null);
        $user->setDateOfBirth(new DateTime($data['dateOfBirth'] ?? 'now'));
        $user->setDateOfRegistration(new DateTime($data['dateOfRegistration'] ?? 'now'));

        try {
            $this->entityManager->persist($user);
            $this->entityManager->flush();
            return JsonResponse::HTTP_CREATED;
        } catch (ORMException $e) {
            return JsonResponse::HTTP_INTERNAL_SERVER_ERROR;
        } catch (DBALException $e) {
            return JsonResponse::HTTP_INTERNAL_SERVER_ERROR;
        } catch (\Exception $e) {
            return JsonResponse::HTTP_INTERNAL_SERVER_ERROR;
        }

        return true;
    }

    public function getUserById(int $userId): array
    {
        return $this->userRepository->findById($userId);
    }

    public function getAllUsers(): array
    {
        return $this->userRepository->getAllUsers();
    }

    public function deleteUser(int $userId): bool
    {
        return  $this->userRepository->deleteById($userId);
    }
}
