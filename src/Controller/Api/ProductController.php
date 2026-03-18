<?php

namespace App\Controller\Api;

use App\DTO\ProductDto;
use App\Entity\Product;
use App\Mapper\ProductMapper;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('api/products', name: 'api_products')]
class ProductController extends AbstractController
{
    #[Route('', name: 'liste_products', methods:['GET'])]
    public function index(ProductRepository $pr, ProductMapper $productMapper): JsonResponse
    {
        $products = $pr->findAllWithImages();
        $data = array_map(
            fn(Product $product) => $productMapper->toDto($product), $products
        );
        return $this->json($data);
    }

    #[Route('/{id}', name: 'product_show', methods:['GET'])]
    public function show(Product $product, ProductMapper $productMapper): JsonResponse
    {
        $data =  $productMapper->toDto($product);
        return $this->json($data);
    }
}