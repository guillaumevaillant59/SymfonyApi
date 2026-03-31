<?php

namespace App\Tests\Integration;

use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class ContactDoctrineTest extends KernelTestCase
{
   private ?EntityManagerInterface $entityManager = null;
   protected function setUp(): void{

        $kernel = self::bootKernel();

        $this->entityManager = static::getContainer()->get('doctrine')->getManager();        
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        if($this->entityManager !== null){
            $this->entityManager->clear();

            $this->entityManager->close();

            $this->entityManager = null;
        }
    }
    public function testDoctrine(): void
    {             
        $contact = new Contact();
        $contact->setNom('Nom 1');
        $contact->setPrenom('Prénom 1');
        $contact->setEmail('test@example.fr');
        $contact->setCommentaire('test');

        $this->entityManager->persist($contact);
        $this->entityManager->flush();

        $repo = $this->entityManager->getRepository(Contact::class);
        $found = $repo->find($contact->getId());

        $this->assertNotNull($contact->getId());
        
    }

    public function testDoctrine2(): void
    {
        $contact = new Contact();
        $contact->setNom('Nom 1');
        $contact->setPrenom('Prénom 1');
        $contact->setEmail('test@example.fr');
        $contact->setCommentaire('test');

        $this->entityManager->persist($contact);
        $this->entityManager->flush();

        $this->entityManager->clear();

        $repo = $this->entityManager->getRepository(Contact::class);
        $found = $repo->find($contact->getId());

        $this->assertNotNull($contact->getId());
        $this->assertEquals($contact->getId(), $found->getId());
        $this->assertSame('Nom 1', $found->getNom());
        $this->assertSame('Prénom 1', $found->getPrenom());
        $this->assertSame('test@example.fr', $found->getEmail());
        $this->assertSame('test', $found->getCommentaire());
    }

}