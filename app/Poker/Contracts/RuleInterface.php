<?php


namespace App\Poker\Contracts;


use App\Poker\HandInterface;

interface RuleInterface
{
    /**
     * To check if hand conforms to a rule
     * @param HandInterface $hand
     * @return bool
     */
    public function applies(HandInterface $hand): bool;

    /**
     * To determine winner. Values in range [-1, 0, 1].
     * @param RuleInterface $other
     * @return int
     */
    public function distance(RuleInterface $other): int;
}
