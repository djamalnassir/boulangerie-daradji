<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // Profile Gerant
        $gerant = new User();
        $hash = $this->encoder->encodePassword($gerant, "gerant");
        $gerant->setUsername("gerant")
             ->setProfile("GERANT")
             ->setPassword($hash);

        $manager->persist($gerant);

        // Profile Comptable
        $comptable = new User();
        $hash = $this->encoder->encodePassword($comptable, "comptable");
        $comptable->setUsername("comptable")
             ->setProfile("COMPTABLE")
             ->setPassword($hash);

        $manager->persist($comptable);

        // Profile Chef
        $chef = new User();
        $hash = $this->encoder->encodePassword($chef, "chef");
        $chef->setUsername("chef")
             ->setProfile("CHEF")
             ->setPassword($hash);

        $manager->persist($chef);

        $manager->flush();
    }
}
