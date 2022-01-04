<?php

namespace App\DataFixtures;

use App\Entity\Deal;
use App\Entity\Category;
use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class DealFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // J'importe la libraire Faker installée via composer
        $faker = Factory::create('fr_FR');

        // Création de 3 catégories
        for($i = 1; $i <= 3; $i++)
        {
            $category = new Category;

            $category ->setName($faker->sentence())
                    ->setDescription($faker->paragraph())
                    ->setColor($faker->hexColor());


            $manager -> persist($category);

            // Création de 5 à 10 deals
            for($j = 1; $j <= mt_rand(5,10); $j++)
            {
                $deal = new Deal;

                $deal ->setTitle($faker->text(255))
                    ->setDescription($faker->text(255))
                    ->setUrl($faker->url())
                    ->setCrossedOutPrice($faker->randomNumber(2))
                    ->setDealPrice($faker->randomNumber(2))
                    ->setDiscount($faker->randomNumber(2))
                    ->setDiscountType("pourcentage")
                    ->setDiscountCode($faker->lexify(5))
                    ->setCurrencyType("Euro")
                    ->setStartAt($faker->dateTimeBetween('-3 months'))
                    ->setEndAt($faker->dateTimeBetween('now','12 months'))
                    ->setShippingCost($faker->randomNumber(2))
                    ->setIsLocal("true")
                    ->setLocalities($faker->city())
                    ->setCategory($category);

                $manager ->persist($deal);

                // Création de 2 à 8 commentaires pour chaque deal
                for($k = 1; $k <= mt_rand(2,8); $k++)
                {
                    $comment = new Comment;

//                    $commentText = '<p>' . join($faker->paragraphs(2), '</p><p>') . '</p>';

                    $now = new \DateTime;
                    $interval = $now->diff($deal->getStartAt()); // retourne un timestamp (temps en secondes entre la date du deal et aujourd'hui
                    $days = $interval->days; // nbr de jours entre la date du deal et aujourd'hui
                    $minimum = "-$days days";

                    $comment-> setTitle($faker->text(45))
                            ->setCommentText($faker->paragraph(2))
                            ->setCreationDate($faker->dateTimeBetween($minimum))
                            ->setDeal($deal);

                            $manager ->persist($comment);
                }
            }

        }

        $manager ->flush();
    }
}

