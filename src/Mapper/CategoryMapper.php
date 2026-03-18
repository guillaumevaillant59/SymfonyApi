<?php

namespace App\Mapper;

use App\DTO\CategoryDto;
use App\Entity\Category;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;
use Symfony\Component\HttpFoundation\UrlHelper;



class CategoryMapper
{
    public function __construct(
        private readonly UploaderHelper $uploaderHelper,
        private readonly UrlHelper $urlHelper,
    ){
    }

    public function toDto(Category $category, ProductMapper $productMapper): CategoryDto
    {
        $imageUrl = null;
        if ($category->getImage()) {
            $path = $this->uploaderHelper->asset($category->getImage(), 'imageFile');
            $imageUrl = $this->urlHelper->getAbsoluteUrl($path);
        }

        $products = [];
        foreach ($category->getProducts() as $item)
            {
                $products[] = $productMapper->toDto($item);
            }

        return new CategoryDto(
            id: $category->getId(),
            name: $category->getName(),
            description: $category->getDescription(),
            products: $products,
            image: $imageUrl
        );
    }
}
