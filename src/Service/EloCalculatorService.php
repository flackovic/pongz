<?php
/**
 * Created by PhpStorm.
 * User: flackovic
 * Date: 13/09/2018
 * Time: 23:58.
 */

namespace App\Service;

use App\Entity\PlayerRating;

/**
 * Class EloCalculatorService.
 *
 * Technical details about how Elo rating is calculated
 *
 * @url https://en.wikipedia.org/wiki/Elo_rating_system
 *
 * Calculator does 3 main things:
 *
 * 1. Transforms/normalizes player rating to extract some of the
 * math logic from next step.
 *
 * 2. Calculates win probability based on player rating vs his opponent rating.
 * Win probability will always be in range from 0 (sure loss) to 1 (sure victory)
 *
 * 3. Updates player rating based on current rating, win probability and actual game outcome.
 * If win probability is high, and player wins the game, new rating will be slightly bigger.
 * on the other hand, if win probability is low, and player wins, it will result in much bigger
 * rating grow. Works for losses too.
 *
 * K Factor is a constant that determines how much will match impact players rating.
 * Bigger the factor - bigger the impact from the match.
 *
 * K Factor is set as 32 for now, as that is factor used for lower ranking players
 * by The United States Chess Federation.
 */
class EloCalculatorService
{
    /** @var int */
    const K_FACTOR = 32;

    /**
     * @param int $playerRating
     *
     * @return int
     */
    public function transformPlayerRating(PlayerRating $rating): int
    {
        return pow(10, $rating->getValue() / 400);
    }

    /**
     * @param int $playerRating
     * @param int $opponentRating
     *
     * @return float
     */
    public function calculateWinProbabilityForPlayer(PlayerRating $rating, PlayerRating $opponentRating): float
    {
        $winProbability = $rating->getValue() / ($rating->getValue() + $opponentRating->getValue());

        return round($winProbability, 2);
    }

    /**
     * @param int $currentRating
     * @param $winProbability
     * @param int $gameOutcome
     *
     * @return int
     */
    public function recalculatePlayerRating(int $currentRating, $winProbability, int $gameOutcome): int
    {
        $newRating = $currentRating + self::K_FACTOR * ($gameOutcome - $winProbability);

        return intval(round($newRating));
    }
}
