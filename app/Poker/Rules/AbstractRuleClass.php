<?php


namespace App\Poker\Rules;


use App\Poker\Contracts\RuleInterface;

abstract class AbstractRuleClass implements RuleInterface
{
    public function distance(RuleInterface $other): int
    {
        return $this->weight() - $other->weight();
    }
}