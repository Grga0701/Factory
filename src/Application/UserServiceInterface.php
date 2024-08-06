<?php

declare(strict_types=1);

namespace App\Application;

use App\Entity\User;

interface UserServiceInterface
{
    public function createUser(array $data): int;

    public function getUserById(int $userId): array;

    public function getAllUsers(): array;

    public function deleteUser(int $userId): bool;
}
