<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Application\UserService;

class UserController extends AbstractController
{
    public function __construct(public UserService $userService)
    {
    }

    #[Route('/user/get/all', name: 'get_all_users')]
    public function GetAllUsers(): JsonResponse
    {
        return new JsonResponse($this->userService->getAllUsers());
    }

    #[Route('/user/get/{id}', name: 'get_user_by_id')]
    public function GetUserById(int $id): JsonResponse
    {
        return new JsonResponse($this->userService->getUserById($id));
    }

    #[Route('/user/create', name: 'save_new_user',  methods: ['POST'])]
    public function SaveUser(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        return new JsonResponse([],$this->userService->createUser($data));
    }

    #[Route('/user/delete/{id}', name: 'delete_user_by_id')]
    public function DeleteUserById(int $id): JsonResponse
    {
        return new JsonResponse($this->userService->deleteUser($id));
    }
}
