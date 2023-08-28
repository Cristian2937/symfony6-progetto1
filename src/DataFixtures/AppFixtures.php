<?php

namespace App\DataFixtures;

use App\Entity\MicroPost;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $date = new DateTime();
        
        $microPost1 = new MicroPost();
        $microPost1->setTitle('First post')
                ->setText("Hello World")
                ->setCreated(new DateTime('2022-08-22'));
        $manager->persist($microPost1);

        $microPost2 = new MicroPost();
        $microPost2->setTitle('Second post')
                ->setText("Hi from Italy!")
                ->setCreated($date);
        $manager->persist($microPost2);

        $microPost3 = new MicroPost();
        $microPost3->setTitle('Third post')
                ->setText("New on the platform")
                ->setCreated($date);
        $manager->persist($microPost3);



        $manager->flush();
    }
}
