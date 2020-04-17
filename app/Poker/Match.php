<?php


namespace App\Poker\Contracts;

use \SplFixedArray;

/**
 * Class Match. Applies to given hands and determines winner
 * @package App\Poker\Contracts
 */
class Match implements MatchInterface
{
    const MAX_PLAYERS = 2;
    private $hands = null;

    /**
     * Match constructor. Initiates array for hands. Again, using fixed array, because size is known
     * in advance.
     */
    public function __construct()
    {
        $this->hands = new SplFixedArray(static::MAX_PLAYERS);
    }

    /**
     * @param HandInterface $hand
     */
    public function addHand(HandInterface $hand): void
    {
        // TODO: Implement addHand() method.
    }

    /**
     * @return HandInterface
     */
    public function pickWinningHand(): HandInterface
    {
        // TODO: Implement pickWinningHand() method.
    }
}
