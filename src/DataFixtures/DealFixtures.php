<?php

namespace App\DataFixtures;

use App\Entity\Deal;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DealFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // J'importe la libraire Faker installée via composer
        $faker = Faker\Factory::create('fr_FR');

        // Création de 3 catégories
        for($i = 1; $i <= 3; $i++)
        {
            $category = new Category;

            $category -> setTitle($faker->sentence())
                    -> setDescription($faker->paragraph());


            $manager -> persist($category);

        }
    }
}

