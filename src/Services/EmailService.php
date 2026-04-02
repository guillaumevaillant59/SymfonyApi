<?php

namespace App\Services;

use App\Entity\Contact;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;

class EmailService
{
    public function sendEmail(MailerInterface $mailer, Contact $contact)
    {
        $email = new TemplatedEmail();
        $email->from(new Address("contact@symfogame.com", "Symfogame Contact"))
        ->to(new Address($contact->getEmail(), $contact->getNom()))
        ->subject('Bonjour')
        ->htmlTemplate('emails/welcome.html.twig')
        ->context(
            [
                'contact' => $contact,
            ]
        );

        $mailer->send($email);
    }
}