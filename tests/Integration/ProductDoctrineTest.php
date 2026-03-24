<?php

namespace App\Tests\Integration;

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

        $em->persist($product);
        $em->flush();

        $this->assertNotNull($product->getId());
        // $myCustomService = static::getContainer()->get(CustomService::class);
    }
}
