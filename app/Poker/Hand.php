<?php


namespace App\Poker;

use App\Poker\Contracts\CardInterface;
use \SplFixedArray;
use \Exception;

class Hand implements HandInterface
{
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
        } else {
            throw new Exception("Cannot exeed max allowed number of cards: {self::CARD_COUNT}");
        }
    }

    public function getCards(): SplFixedArray
    {
        return $this->cards;
    }


    private function check(): bool
    {
        return static::CARD_COUNT < count($this->cards);
    }
}
