<?php

namespace App\Application;

use App\Entity\User;

interface UserServiceInterface
{
    public function createUser(array $data): bool;

    public function getUserById(int $userId): User;

    public function getAllUsers(): array;

    public function deleteUser(int $userId): bool;
}
