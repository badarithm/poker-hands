<?php


namespace App\Poker;


use App\Poker\Contracts\CardInterface;
use Illuminate\Support\Facades\Log;

class Card implements CardInterface
{
    /**
     * Jkr, A, K, Q, J, 10 - 2
     */
    private $rank = null;

    /**
     * H - Hearts,
     * D - Diamonds,
     * C - Crosses,
     * S - Spades,
     */
    private $suit = null;

    /**
     * Likely will come in as 3C, AD, 3H, etc..
     * Card constructor.
     * @param string $rank
     * @param string $suit
     */
    public function __construct(string $card)
    {
        [$rank, $suit] = str_split($card, 1);
        $this->rank = new CardRank($rank);
        $this->suit = $suit;
    }

    public function getRank(): string
    {
        return $this->rank->getRank();
    }

    public function getRankNumber(): int
    {
        return $this->rank->getWeight();
    }

    public function getSuit(): string
    {
        return $this->suit;
    }

    public function getCard(): string
    {
        return "{$this->rank->getRank()}{$this->suit}";
    }

    /**
     * Return -1, 0, 1 as in comparison functions
     * @param Card $card
     * @return int
     */
    public function distance(CardInterface $card): int
    {
        return $this->getRankNumber() - $card->getRankNumber();
    }

    /**
     * Since it can be the same or not
     * @param Card $card
     * @return int
     */
    public function sameSuite(CardInterface $card): bool
    {
        return $card->getSuit() === $this->getSuit();
    }

    public function sameRank(CardInterface $card): bool
    {
        return $this->getRank() === $card->getRank();
    }

    public function compare(CardInterface $other): int
    {
        $distance = $this->distance($other);
        if (0 === $distance) {
            return 0;
        } else {
            return 0 > $distance ? -1 : 1;
        }
    }
}
