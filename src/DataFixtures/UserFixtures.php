<?php

namespace App\DataFixtures;

use App\Entity\PlayerRating;
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

        for ($i = 0; $i < self::NUM_OF_USERS; ++$i) {
            $user = new User();
            $user->setUsername($faker->userName);
            $user->setFullName(sprintf('%s %s', $faker->firstName, $faker->lastName));
            $user->setEmail($faker->email);
            $user->setActive($faker->boolean);
            $manager->persist($user);

            $playerRating = new PlayerRating();
            $playerRating->setPlayer($user);
            $playerRating->setValue($faker->numberBetween(1000, 2500));
            $manager->persist($playerRating);
        }

        $manager->flush();
    }
}
