<?php

declare(strict_types=1);

namespace App\Application;

interface ContractListServiceInterface
{
    public function createContractList(array $data): int;

    public function getContractListByIdAndSku(int $userId, int $sku): array;

    public function getAllContractsForAUser(int $userID): array;

    public function deleteContractList(int $contractListId): bool;
}
