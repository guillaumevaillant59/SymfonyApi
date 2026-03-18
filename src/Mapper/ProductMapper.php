<?php

namespace App\Mapper;

use App\DTO\ProductDto;
use App\Entity\Product;
use Symfony\Component\HttpFoundation\UrlHelper;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class ProductMapper{
    public function __construct(
        private readonly UploaderHelper $uploaderHelper,
        private readonly UrlHelper $urlHelper,
        
        ) {
    }

    public function toDto(Product $product): ProductDto
    {
        $imageUrls = [];

        foreach ($product->getImages() as $image) {

        $path = $this->uploaderHelper->asset($image, 'imageFile');
        if ($path) {
           $imageUrls[] = $this->urlHelper->getAbsoluteUrl($path);
        }
            
        }

        return new ProductDto(
            id : $product->getId(),
            name: $product->getName(),
            description: $product->getDescription(),
            isActive: $product->isActive(),
            stock: $product->isStock(),
            images: $imageUrls
        );
    }
}