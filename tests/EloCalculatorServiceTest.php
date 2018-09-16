<?php

namespace App\Tests;

use App\Dictionary\GameOutcomeDictionary;
use App\Service\EloCalculatorService;
use PHPUnit\Framework\TestCase;

class EloRatingTest extends TestCase
{
    /** @var EloCalculatorService */
    private $eloCalculator;

    public function setUp()
    {
        $this->eloCalculator = new EloCalculatorService();
    }

    /**
     * @param int $playersRating
     * @param int $expectedTransformedRating
     *
     * @dataProvider providePlayersRatingData
     */
    public function testTransformPlayerRatingWillReturnCorrectTransformedRating(int $playersRating, int $expectedTransformedRating)
    {
        $transformedRating = $this->eloCalculator->transformPlayerRating($playersRating);

        $this->assertSame($expectedTransformedRating, $transformedRating);
    }

    /**
     * @param int $playerRating
     * @param int $opponentRating
     * @param float $expectedWinProbability
     *
     * @dataProvider providePlayersTransformedRatingData
     */
    public function testCalculateExpectedOutcomeForPlayerWillReturnCorrectOutcome(int $playerRating, int $opponentRating, float $expectedWinProbability)
    {
        $winProbability = $this->eloCalculator->calculateWinProbabilityForPlayer($playerRating, $opponentRating);

        $this->assertSame($expectedWinProbability, $winProbability);
    }

    /**
     * @param int $oldRating
     * @param float $winProbability
     * @param int $gameOutcome
     *
     * @dataProvider provideRecalculatePlayerRatingData
     */
    public function testRecalculatePlayerRatingWillReturnCorrectNewRating(int $currentRating, float $winProbability, int $gameOutcome, int $expectedNewRating)
    {
        $newRating = $this->eloCalculator->recalculatePlayerRating($currentRating, $winProbability, $gameOutcome);

        $this->assertSame($expectedNewRating, $newRating);
    }

    public function provideRecalculatePlayerRatingData()
    {
        return [
            [2400, 0.91, GameOutcomeDictionary::GAME_WON, 2403],
            [2000, 0.09, GameOutcomeDictionary::GAME_LOST, 1997],
            [2400, 0.91, GameOutcomeDictionary::GAME_LOST, 2371],
            [2000, 0.09, GameOutcomeDictionary::GAME_WON, 2029],
        ];
    }

    public function providePlayersTransformedRatingData()
    {
        return [
            [1000000, 100000, 0.91],
            [100000, 1000000, 0.09]
        ];
    }
    
    public function providePlayersRatingData()
    {
        return [
            [2400, 1000000],
            [2000, 100000]
        ];
    }
}
