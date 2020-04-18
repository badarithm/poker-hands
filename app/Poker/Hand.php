<?php


namespace App\Poker;

use App\Poker\Contracts\CardInterface;
use App\Poker\Contracts\HandInterface;
use \SplFixedArray;
use \Exception;

/**
 * Example HandInterface implementation.
 * Class Hand
 * @package App\Poker
 */
class Hand implements HandInterface
{
    /**
     * This is pretty much set in stone in our case
     */
    const CARD_COUNT = 5;
    private $cards = null;

    /**
     * Hand constructor. Using fixed array, because
     */
    public function __construct()
    {
        $this->cards = new SplFixedArray(static::CARD_COUNT);
    }

    public function addCard(CardInterface $card): void
    {
        if ($this->check()) {
            array_push($this->cards, $card);
            usort($this->cards, new class {
                public final function __invoke(CardInterface $first, CardInterface $second)
                {
                    return $first->getRank() < $second->getRank() ? -1 : 1;
                }
            });
        } else {
            throw new Exception("Cannot exeed max allowed number of cards: {self::CARD_COUNT}");
        }
    }

    public function getCards(): SplFixedArray
    {
        return $this->cards;
    }

    /**
     * To determine if one more can be added
     * @return bool
     */
    private function check(): bool
    {
        return static::CARD_COUNT < count($this->cards);
    }

    public function max(): int
    {
        return static::CARD_COUNT;
    }

    public function min(): int
    {
        return $this->max();
    }
}
