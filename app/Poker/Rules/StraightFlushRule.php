<?php


namespace App\Poker\Rules;


use App\Poker\Hand;

/**
 * All cards have same suit, and rank decreases consequentialy by 1
 * Class StraightFlushRule
 * @package App\Poker\Rules
 */
class StraightFlushRule implements RuleInterface
{
    /**
     * @param Hand $hand
     * @return bool
     */
    public function applies(Hand $hand): bool
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
