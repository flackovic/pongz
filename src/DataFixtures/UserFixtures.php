<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {
            $user = new User();
            $user->setUsername(sprintf('user_%d', $i));
            $user->setEmail(sprintf('user_%d@email.loc', $i));
            $user->setActive(true);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
