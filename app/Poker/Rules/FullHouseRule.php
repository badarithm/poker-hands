<?php


namespace App\Poker\Rules;


use App\Poker\HandInterface;

class FullHouseRule implements RuleInterface
{

    /**
     * @param HandInterface|Hand $hand
     * @return bool
     */
    public function applies(HandInterface $hand): bool
    {
        // TODO: Implement applies() method.
    }

    /**
     * @param RuleInterface $other
     * @return int
     */
    public function distance(RuleInterface $other): int
    {
        // TODO: Implement distance() method.
    }
}
