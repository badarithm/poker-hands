<?php


namespace App\Poker\Contracts;

use \SplFixedArray;

interface HandInterface
{
    /**
     * Card setter. Should apply limits and checks (same card twice, etc..)
     * @param CardInterface $card
     */
    public function addCard(CardInterface $card): void;

    /**
     * Return an ordered list of all cards. The higher ones should be at the top because in most rules
     * first higher card wins. Return type should be SplFixedArray<CardInterface>.
     * @return SplFixedArray
     */
    public function getCards(): SplFixedArray;

    /**
     * To know max number of cards allowed
     * @return int
     */
    public function max(): int;
}
