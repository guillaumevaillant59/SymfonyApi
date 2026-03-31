<?php

namespace App\Tests;

use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContactControllerTest extends WebTestCase
{
    private ?EntityManagerInterface $em = null;

    protected function setUp(): void{
        $this->em = null;
    }
    protected function tearDown(): void{
        parent::tearDown();
        if($this->em !== null) {
            $this->em->clear();
            $this->em->close();
            $this->em = null;
        }
    }
    private function getEntityManagerFromClient($client): EntityManagerInterface
    {
        $em = $client->getContainer()->get('doctrine')->getManager();

        try {
            $em->getConnection()->executeQuery('SELECT 1');
        } catch (\Exception $e) {
            $this->markTestSkipped('Database not available for tests: '.$e->getMessage());
        }

        return $em;
    }
    public function testGetAll(): void
    {
        $client = static::createClient();
        $client->request('GET', '/contact');

        self::assertResponseIsSuccessful();
        self::assertResponseStatusCodeSame(200);
    }

    public function testGetFormulaire(): void {
        $client = static::createClient();
        $client->request('GET', '/contact/new');

        self::assertResponseIsSuccessful();
        self::assertResponseStatusCodeSame(200);
    }

    public function testFormulaire() : void {
        $client = static::createClient();
        $crawler = $client->request('GET', '/contact/new');

        $form = $crawler->selectButton('Save')->form([
            'contact[nom]'=> 'Nom 2',
            'contact[prenom]'=> 'Prénom 2',
            'contact[email]'=> 'test2@example.fr'
        ]);


        $client->submit($form);

        $this->em = $this->getEntityManagerFromClient($client);

        $this->assertTrue($client->getResponse()->isRedirect());

        $created = $this->em->getRepository(Contact::class)->findOneBy(['email' => 'test2@example.fr']);
        $this->assertNotNull($created);
        $this->assertSame('Nom 2', $created->getNom());

        $client->followRedirect();
    }

    public function testFormulaireInvalide() : void {
        $client = static::createClient();
        
        $this->em = $this->getEntityManagerFromClient($client);

        $repo = $this->em->getRepository(Contact::class);
        $avant = count($repo->findAll());

        $crawler = $client->request('GET', '/contact/new');

        $form = $crawler->selectButton('Save')->form([
            'contact[nom]'=> 'Nom 2',
            'contact[prenom]'=> 'Prénom 2',
            'contact[email]'=> ''
        ]);

        $client->submit($form);

        $this->assertFalse($client->getResponse()->isRedirect());

        $apres = count($repo->findAll());
        $this->assertSame($avant, $apres);
    }
}
