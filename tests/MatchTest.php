<?php

namespace App\Tests;

use App\Entity\Match;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class MatchTest extends TestCase
{
    const PLAYER_ONE_USERNAME = 'player-one';
    const PLAYER_TWO_USERNAME = 'player-two';

    /** @var User */
    private $playerOne;
    /** @var User */
    private $playerTwo;
    /** @var Match */
    private $match;

    public function setUp()
    {
        $this->playerOne = $this->createConfiguredMock(User::class, ['getUsername' => self::PLAYER_ONE_USERNAME]);
        $this->playerTwo = $this->createConfiguredMock(User::class, ['getUsername' => self::PLAYER_TWO_USERNAME]);

        $this->match = new Match();
        $this->match->setPlayerOne($this->playerOne);
        $this->match->setPlayerTwo($this->playerTwo);
        $this->match->setWinner($this->playerTwo);
    }

    public function testGetPlayerOneWillReturnInstanceOfUser()
    {
        $this->assertInstanceOf(User::class, $this->match->getPlayerOne());
    }

    public function testGetPlayerTwoWillReturnInstanceOfUser()
    {
        $this->assertInstanceOf(User::class, $this->match->getPlayerTwo());
    }

    public function testGetWinnerWillReturnInstanceOfUser()
    {
        $this->assertInstanceOf(User::class, $this->match->getWinner());
    }

    /**
     * @dataProvider provideTotalSetsData
     */
    public function testGetSetsPlayedWillReturnCorrectNumberOfSets(int $playerOneScore, int $playerTwoScore, int $setsPlayed)
    {
        $this->match->setPlayerOneScore($playerOneScore);
        $this->match->setPlayerTwoScore($playerTwoScore);

        $this->assertSame($setsPlayed, $this->match->getSetsPlayed());
    }

    /**
     * @dataProvider provideWinnerData
     */
    public function testDeclareWinnerWillDeclareCorrectPlayerAsAWinner(int $playerOneScore, int $playerTwoScore, string $winnerUsername)
    {
        $this->match->setPlayerOneScore($playerOneScore);
        $this->match->setPlayerTwoScore($playerTwoScore);

        $this->match->declareWinner();

        $this->assertSame($this->match->getWinner()->getUsername(), $winnerUsername);
    }

    /**
     * @dataProvider provideDrawData
     */
    public function testDeclareWinnerWillSetWinnerAsNullIfDraw(int $playerOneScore, int $playerTwoScore)
    {
        $this->match->setPlayerOneScore($playerOneScore);
        $this->match->setPlayerTwoScore($playerTwoScore);

        $this->match->declareWinner();

        $this->assertNull($this->match->getWinner());
    }

    /**
     * Provides match data and total sets count
     *
     * @return array
     */
    public function provideTotalSetsData()
    {
        return [
            [0, 3, 3],
            [1, 3, 4],
            [2, 3, 5],
            [3, 0, 3],
            [3, 1, 4],
            [3, 2, 5],
        ];
    }

    /**
     * Provides match data and winner
     *
     * @return array
     */
    public function provideWinnerData()
    {
        return [
            [0, 3, self::PLAYER_TWO_USERNAME],
            [1, 3, self::PLAYER_TWO_USERNAME],
            [2, 3, self::PLAYER_TWO_USERNAME],
            [3, 0, self::PLAYER_ONE_USERNAME],
            [3, 1, self::PLAYER_ONE_USERNAME],
            [3, 2, self::PLAYER_ONE_USERNAME],
        ];
    }

    /**
     * Provides match data where score is a draw
     *
     * @return array
     */
    public function provideDrawData()
    {
        return [
            [0, 0],
            [1, 1],
            [2, 2],
            [3, 3],
        ];
    }
}
