<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory as FakerFactory;

class UserFixtures extends Fixture
{
    const NUM_OF_USERS = 100;

    public function load(ObjectManager $manager)
    {
        $faker = FakerFactory::create();

        for ($i = 0; $i < self::NUM_OF_USERS; $i++) {
            $user = new User();
            $user->setUsername($faker->userName);
            $user->setEmail($faker->email);
            $user->setActive($faker->boolean);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
