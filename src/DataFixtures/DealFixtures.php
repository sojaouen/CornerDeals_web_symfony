<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DealFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        // Création de 10 'faux' deals
        for ($i = 1; $i <= 10; $i++)
        {
            $deal = new Deal;

            $deal-›setTitle("Titre du deal n° $i")
                -›setDescription("<p>Contenu du deal $i</p>")
                ->setDealPrice(new \float);
                -›setImage("https://picsum.photos/600/400")
                -›setStartAt (new \DateTime); // on instancie la classe DateTime afin d' avoir automatiquement la date et l'heure dans la BDD

        $manager->persist($deal);
        }

        $manager->flush();

 //une fois les fixtures réaliseés, il faut les charger en BDD grace à doctrine (ORM) par la commande
 //php bin/console doctrine:fixtures:load
    }
}

