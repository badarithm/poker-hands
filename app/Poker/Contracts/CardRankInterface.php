<?php


namespace App\Poker\Contracts;


interface CardRankInterface
{
    /**
     * Returns same symbol that was given
     * @return string
     */
    public function getRank(): string ;

    /**
     * Some numeric representation of current card. To sort, compare, calculate distances, etc..
     * @return int
     */
    public function getWeight(): int ;

    /**
     * Compares this card with a given one.
     * 0 if weight is the same
     * 0 < if this card is smaller
     * 0 > if this card is bigger
     * @param CardRankInterface $other
     * @return int
     */
    public function distance(CardRankInterface $other): int ;

    /**
     * If distance is -1 or 1.
     * In many cases have to determine if there is a number of cards that are +1
     * in rank.
     * @param CardRankInterface $other
     * @return bool
     */
    public function isSuccessive(CardRankInterface $other): bool ;
}
