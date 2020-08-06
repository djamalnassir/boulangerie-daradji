<?php

namespace App\DataFixtures;

use App\Entity\MagasinStock;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class MagasinStockFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        
        $magasin = new MagasinStock();
        $magasin->setNom("Magasin Daradji")
             ->setAdresse("Diourbel, Quartier Escale");

        $manager->persist($magasin);

        $manager->flush();
    }
}
