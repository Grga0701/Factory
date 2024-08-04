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
        $user = new User($data['name'], $data['description'], $data['price'], $data['SKU'], $data['published']);
        return $this->userRepository->save($user);
    }

    public function getUserById(int $userId): User
    {
        $data = $this->userRepository->findById($userId);
        $user = new User($data['name'], $data['description'], $data['price'], $data['SKU'], $data['published']);

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
