<?php


namespace App\Poker\Rules;


use App\Poker\Hand;
use App\Poker\HandInterface;

/**
 * Applies only
 * Class FiveOfAKindRule
 * @package App\Poker\Rules
 */
class FiveOfAKindRule implements RuleInterface
{

    /**
     * @inheritDoc
     */
    public function applies(HandInterface $hand): bool
    {
        // TODO: Implement applies() method.
    }

    /**
     * @inheritDoc
     */
    public function distance(RuleInterface $other): int
    {
        // TODO: Implement distance() method.
    }
}
