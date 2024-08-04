<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Application\OrderService;

class OrderController extends AbstractController
{
    public function __construct(public OrderService $orderService)
    {
    }

    #[Route('/order/get/all', name: 'get_all_orders')]
    public function GetAllOrders(): JsonResponse
    {
        return new JsonResponse($this->orderService->getAllOrders());
    }

    #[Route('/order/get/{id}', name: 'get_order_by_id')]
    public function GetOrderById(int $id): JsonResponse
    {
        return new JsonResponse($this->orderService->getOrderById($id));
    }

    #[Route('/order/post', name: 'save_new_order',  methods: ['POST'])]
    public function CreateOrder(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        return new JsonResponse($this->orderService->createOrder($data));
    }

    #[Route('/order/delete/{id}', name: 'delete_order_by_id')]
    public function DeleteOrderById(int $id): JsonResponse
    {
        return new JsonResponse($this->orderService->deleteOrder($id));
    }
}
