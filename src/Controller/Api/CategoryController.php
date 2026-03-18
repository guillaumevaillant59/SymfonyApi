<?php

namespace App\Controller\Api;

use App\DTO\CategoryDto;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Mapper\CategoryMapper;
use App\Mapper\ProductMapper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('api/category', name: 'api_category')]
class CategoryController extends AbstractController
{
    #[Route('', name: '_liste_category', methods: ['GET'])]
    public function index(CategoryRepository $categoryRepository,
        CategoryMapper $categoryMapper, 
        ProductMapper $productMapper
        ): JsonResponse
    {
        $categories = $categoryRepository->findAll();
        $categoryDtos = array_map(fn(Category $category) => $categoryMapper->toDto($category, $productMapper), $categories);

        return $this->json($categoryDtos);
    }
}
