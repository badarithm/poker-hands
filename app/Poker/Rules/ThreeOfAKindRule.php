<?php


namespace App\Poker\Rules;


use App\Poker\Contracts\RuleInterface;
use App\Poker\HandInterface;

class ThreeOfAKindRule implements RuleInterface
{

    public function applies(HandInterface $hand): bool
    {
        // TODO: Implement applies() method.
    }

    public function distance(RuleInterface $other): int
    {
        // TODO: Implement distance() method.
    }
}
