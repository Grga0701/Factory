<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Application\PriceListService;

class PriceListController extends AbstractController
{
    public function __construct(public PriceListService $priceListService)
    {
    }

    #[Route('/priceList/get/all', name: 'get_all_priceLists')]
    public function GetAllPriceLists(): JsonResponse
    {
        return new JsonResponse($this->priceListService->getAllPriceLists());
    }

    #[Route('/priceList/get/{id}', name: 'get_priceList_by_id')]
    public function GetPriceListsById(int $id): JsonResponse
    {
        return new JsonResponse($this->priceListService->getPriceListById($id));
    }

    #[Route('/priceList/post', name: 'save_new_priceList',  methods: ['POST'])]
    public function SavePriceList(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        return new JsonResponse($this->priceListService->createPriceList($data));
    }

    #[Route('/priceList/delete/{id}', name: 'delete_priceList_by_id')]
    public function DeletePriceListsById(int $id): JsonResponse
    {
        return new JsonResponse($this->priceListService->deletePriceList($id));
    }
}
