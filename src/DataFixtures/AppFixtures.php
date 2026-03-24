<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Product;
use App\Entity\User;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $categories = [];

        for ($i=0; $i <5 ; $i++) { 
            $categorie = new Category();
            $categorie->setName("Nom de la categorie $i" );
            $categorie->setDescription("Nom de la description $i" );

            $categories[] = $categorie;
        }

        foreach ($categories as $categorie) {
            # code...
            for ($i = 0; $i <= 10; $i++) {
                $product = new Product();
                $product->setName("Produit $i");
                $product->setDescription("description du produit: $i");
                $product->setIsActive(true);
                $product->setStock(true);
                $product->setCategory($categorie);
                $manager->persist($product);
                $manager->persist($categorie);
            }
        }

        $user = new User();
        $user->setEmail('admin@example.com');
        $user->setPassword(password_hash('password', PASSWORD_DEFAULT));
        $user->setRoles(['ROLE_ADMIN','ROLE_USER']);
        $manager->persist($user);

        $manager->flush();
    }
}
