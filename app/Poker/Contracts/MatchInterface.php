<?php


namespace App\Poker\Contracts;


/**
 * Interface MatchInterface
 * @package App\Poker
 */
interface MatchInterface
{
    /**
     * Will add a hand. There
     * @param HandInterface $hand
     */
    public function addHand(HandInterface $hand): void;

    /**
     * Apply all Rules and determine a winner
     * @return HandInterface
     */
    public function pickWinningHand(): ?HandInterface;

    /**
     * Set added values to their initial state
     */
    public function resetHands(): void;
}
