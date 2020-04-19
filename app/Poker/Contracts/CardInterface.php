<?php


namespace App\Poker\Contracts;


interface CardInterface
{

    public function getRank(): string;

    public function getSuit(): string;

    public function getCard(): string;

    /**
     * Return int distance. Because reference point in this
     * comparison is given card, thus negative distance
     * means lower card, positive distance means
     * the other card is higher.
     * In a nutshell current rank + distance = rank of another card.
     * @return int
     */
    public function distance(): int;

    /**
     * Returns -1, 0, 1. To be used in order methods when adding to a hand
     * @param CardInterface $other
     * @return int
     */
    public function compare(CardInterface $other): int;

    /**
     * Answers the question if suite is the same
     * @param CardInterface $other
     * @return bool
     */
    public function sameSuite(CardInterface $other): bool;

    /**
     * Answers the question is rank is the same
     * @param CardInterface $other
     * @return bool
     */
    public function sameRank(CardInterface $other): bool;
}
