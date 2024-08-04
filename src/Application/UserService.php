<?php

namespace App\Application;

use App\Entity\User;
use App\Application\UserServiceInterface;
use App\Repository\UserRepository;

class UserService implements UserServiceInterface
{

    public function __construct(public UserRepository $userRepository)
    {
    }

    public function createUser(array $data): bool
    {
        return $this->userRepository->save($data);
    }

    public function getUserById(int $userId): User
    {
        $data = $this->userRepository->findById($userId);
        $user = new User(
            $data['id'],
            $data['name'],
            $data['lastname'],
            $data['address'],
            $data['phone_number'],
            $data['date_of_birth'],
            $data['date_of_registration']
        );

        return $user;
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
