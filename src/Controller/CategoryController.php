<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Application\CategoryService;

class CategoryController extends AbstractController
{
    public function __construct(public CategoryService $categoryService)
    {
    }

    #[Route('/category/get/all', name: 'get_all_categorys')]
    public function GetAllCategories(): JsonResponse
    {
        return new JsonResponse($this->categoryService->getAllCategories());
    }

    #[Route('/category/get/{id}', name: 'get_category_by_id')]
    public function GetCategoriesById(int $id): JsonResponse
    {
        return new JsonResponse($this->categoryService->getCategoryById($id));
    }

    #[Route('/category/post', name: 'save_new_category',  methods: ['POST'])]
    public function SaveCategory(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        return new JsonResponse($this->categoryService->createCategory($data));
    }

    #[Route('/category/delete/{id}', name: 'delete_category_by_id')]
    public function DeleteCategoriesById(int $id): JsonResponse
    {
        return new JsonResponse($this->categoryService->deleteCategory($id));
    }
}
