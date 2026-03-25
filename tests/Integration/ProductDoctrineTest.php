<?php

namespace App\Tests\Integration;

use App\Entity\Image;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ProductDoctrineTest extends KernelTestCase
{
    public function testSomething(): void
    {
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());

        $em = static::getContainer()->get('doctrine')->getManager();
        $product = new Product() ;
        $product->setName('Produit test');
        $product->setIsActive(true);
        $product->setStock(true);

        $image = new Image();
        $image->setName('test.jpg');
        $product->addImage($image);

        $em->persist($product);
        $em->flush();

        $repo = $em->getRepository(Product::class);
        $found = $repo->find($product->getId());

        $this->assertNotNull($product->getId());
        $this->assertNotNull($image->getId());
        $this->assertSame('Produit test', $found->getName());

        // $myCustomService = static::getContainer()->get(CustomService::class);
    }
}
