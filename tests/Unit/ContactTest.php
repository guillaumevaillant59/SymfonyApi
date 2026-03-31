<?php

namespace App\Tests\Unit;

use App\Entity\Contact;
use PHPUnit\Framework\TestCase;

final class ContactTest extends TestCase
{
    public function testsUnitaires(): void
    {
        $contact = new Contact();
        $contact->setNom("Nom 1");
        $contact->setPrenom("Prénom 1");
        $contact->setEmail("test@example.fr");
        $contact->setCommentaire("test");
        $this->assertSame("Nom 1", $contact->getNom());
        $this->assertSame("Prénom 1", $contact->getPrenom());
        $this->assertSame("test@example.fr", $contact->getEmail());
        $this->assertSame("test", $contact->getCommentaire());


    }

}