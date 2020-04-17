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
     * first higher card wins.
     * @return SplFixedArray
     */
    public function getCards(): SplFixedArray;
}
