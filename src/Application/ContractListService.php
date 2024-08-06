<?php

declare(strict_types=1);

namespace App\Application;

use App\Entity\ContractList;
use App\Application\ContractListServiceInterface;
use App\Repository\ContractListRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\DBAL\Exception as DBALException;

class ContractListService implements ContractListServiceInterface
{
    public function __construct(
        public ContractListRepository $contractListRepository, 
        public EntityManagerInterface $entityManager,
    )
    {
    }

    public function createContractList(array $data): int
    {
        $contractList = new ContractList($data['user_id'], $data['price'], $data['SKU'], $data['modificator'], $data['modificator_value']);

        try {
            $this->entityManager->persist($contractList);
            $this->entityManager->flush();
            return JsonResponse::HTTP_CREATED;
        } catch (ORMException $e) {
            return JsonResponse::HTTP_INTERNAL_SERVER_ERROR;
        } catch (DBALException $e) {
            return JsonResponse::HTTP_INTERNAL_SERVER_ERROR;
        } catch (\Exception $e) {
            return JsonResponse::HTTP_INTERNAL_SERVER_ERROR;
        }
    }

    public function getContractListByIdAndSku(int $userId, int $sku): array
    {
        return $this->contractListRepository->getContractListByUserIdAndSKU($userId, $sku);
    }

    public function getAllContractsForAUser(int $userId): array
    {
       return $this->contractListRepository->getAllContractsForAUser($userId);
    }

    public function deleteContractList(int $contractListId): bool
    {
        return $this->contractListRepository->deleteById($contractListId);
    }
}
