<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Application\ContractListService;


class ContractListController extends AbstractController
{
    public function __construct(public ContractListService $contractListService)
    {
    }

    #[Route('/contract_list/get/all/user/{userId}', name: 'get_all_contractLists')]
    public function GetAllContractLists(int $userId): JsonResponse
    {
        return new JsonResponse($this->contractListService->getAllContractsForAUser($userId));
    }

    #[Route('/contract_list/get', name: 'get_contractList_by_id',  methods: ['POST'])]
    public function GetContractListsById(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        return new JsonResponse($this->contractListService->getContractListByIdAndSku($data['contract_list_id'], $data['SKU']));
    }

    #[Route('/contract_list/create', name: 'save_new_contractList',  methods: ['POST'])]
    public function SaveContractList(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        return new JsonResponse($this->contractListService->createContractList($data));
    }

    #[Route('/contract_list/delete/{contractListId}', name: 'delete_contractList_by_id')]
    public function DeleteContractListsById(int $contractListId): JsonResponse
    {
        return new JsonResponse($this->contractListService->deleteContractList($contractListId));
    }
}
