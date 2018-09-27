<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Match;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory as FakerFactory;

class MatchFixtures extends Fixture implements DependentFixtureInterface
{
    const NUM_OF_MATCHES = 400;

    /** @var User[] */
    private $users;

    public function load(ObjectManager $manager)
    {
        $faker          = FakerFactory::create();
        $userRepository = $manager->getRepository(User::class);
        $this->users    = $userRepository->findAll();

        for ($i = 0; $i < self::NUM_OF_MATCHES; ++$i) {
            /* Draw players, but make sure they are not same user. */
            do {
                $playerOne = $this->getRandomUser();
                $playerTwo = $this->getRandomUser();
            } while ($playerOne === $playerTwo);

            /** Get random date this month as start date, and add 5 - 25 minutes as ended date */
            $startedAt = $faker->dateTimeThisMonth('now');
            $endedAt   = clone $startedAt;
            $endedAt->add(new \DateInterval('PT'.$faker->numberBetween(5, 25).'M'));

            $match = new Match();
            $match->setPlayerOne($playerOne);
            $match->setPlayerTwo($playerTwo);
            $match->setStartedAt($startedAt);
            $match->setEndedAt($endedAt);

            /* Set random scores and declare winner, but make sure scores are valid. */
            do {
                $match->setPlayerOneScore($faker->numberBetween(0, 3));
                $match->setPlayerTwoScore($faker->numberBetween(0, 3));
                $match->declareWinner();
            } while (!$match->isScoreValid() || null == $match->getWinner());

            $manager->persist($match);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }

    /**
     * @param array $users
     *
     * @return User
     */
    private function getRandomUser(): User
    {
        return $this->users[array_rand($this->users)];
    }
}
