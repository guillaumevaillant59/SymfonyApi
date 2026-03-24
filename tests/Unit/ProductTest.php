<?php

namespace App\Tests\Unit;

use App\Entity\Image;
use App\Entity\Product;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;


final class ProductTest extends TestCase
{
    public function testName(): void    
	{        
		$product = new Product();   
        $product->setName("Test");
        self::assertSame('Test', $product->getName());
	}

    public function testFalse(): void
    {
        $product = new Product();
        $product->setIsActive(false);
        self::assertFalse($product->isActive());
    }

    public function testDescription(): void
    {
        $product = new Product();
        self::assertNull($product->getDescription());
    }

    public function testImage(): void
    {
        $image = new Image();
        $image->setName('photo.png');
        self::assertSame('photo.png', $image->getName());
    }

    public function testRelation(): void
    {
        $product = new Product();
        $image = new Image();
        $image->setProduct($product);
        $product->addImage($image);
        self::assertCount(1, $product->getImages());
        self::assertSame($product, $image->getProduct());
    }

    public function testImageFile(): void
    {
        $image = new Image();
        $firstUpdateTime = $image->getUpdatedAt();
        self::assertNull($firstUpdateTime);        
        $image->setImageFile(new UploadedFile("public/uploads/images/mojito.jpg", "mojito.jpg"));
        $secondUpdateTime = $image->getUpdatedAt();
        self::assertNotNull($secondUpdateTime);
        self::assertNotEquals($firstUpdateTime,$secondUpdateTime);        

    }

}