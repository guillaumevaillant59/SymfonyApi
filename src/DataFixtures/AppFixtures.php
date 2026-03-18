<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Product;
use App\Entity\User;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // for($i = 1; $i <= 10; $i++) {
        //     $product = new Product();
        //     $product->setName('Product ' . $i);
        //     $product->setDescription('Description for product ' . $i);
        //     $product->setIsActive(true);
        //     $product->setStock(true);
        //     $manager->persist($product);
        // }

        $user = new User();
        $user->setEmail('admin@example.com');
        $user->setPassword(password_hash('password', PASSWORD_DEFAULT));
        $user->setRoles(['ROLE_ADMIN','ROLE_USER']);
        $manager->persist($user);

        $manager->flush();
    }
}
