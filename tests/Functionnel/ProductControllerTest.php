<?php

namespace App\Tests\Functionnel;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductControllerTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $client->request('GET', '/product');

        self::assertResponseIsSuccessful();
        self::assertResponseStatusCodeSame(200);
    }

    public function testFormulaire(): void{

        $client = static::createClient();
        $crawler = $client->request('GET', '/product/new');

        $form = $crawler->selectButton('Save')->form([
            'product[name]' => 'Produit Test2',
            'product[isActive]'=> true,
            'product[stock]'=> true
            
        ]);

        $client->submit($form);

        self::assertResponseRedirects();

        $client->followRedirect();

        self::assertResponseIsSuccessful();

        
    }

     
}
