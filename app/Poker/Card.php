<?php


namespace App\Poker;


use App\Poker\Rules\CardInterface;
use phpDocumentor\Reflection\Types\Boolean;

class Card implements CardInterface
{
    private $rank = null;
    private $suit = null;

    public function __construct(string $rank, string $suit)
    {
        /**
         * Jkr, A, K, Q, J, 10 - 2
         */
        $this->rank = $rank;
        $this->suit = $suit;
    }

    public function getRank(): string
    {
        return $this->rank;
    }

    public function getSuit(): string
    {
        return $this->suit;
    }

    public function getCard(): string
    {
        return "{$this->rank}{$this->suit}";
    }

    /**
     * Return -1, 0, 1 as in comparison functions
     * @param Card $card
     * @return int
     */
    public function compareRank(CardInterface $card): int
    {

    }

    /**
     * Since it can be the same or not
     * @param Card $card
     * @return int
     */
    public function sameSuit(Card $card): bool
    {
        return $card->getSuit() === $this->getSuit();
    }

    public function sameRank(Card $card): bool
    {
        return $this->getRank() === $card->getRank();
    }
}
