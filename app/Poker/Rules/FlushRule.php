<?php


namespace App\Poker\Rules;


use App\Poker\Hand;
use App\Poker\HandInterface;

class FlushRule implements RuleInterface
{

    /**
     * @param Hand $hand
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
