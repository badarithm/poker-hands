<?php


namespace App\Poker\Rules;


use App\Poker\Contracts\HandInterface;
use App\Poker\Contracts\RuleInterface;

/**
 * There will be some very common methods to all rules.
 * Used this article for reference: https://en.wikipedia.org/wiki/List_of_poker_hands
 * Class AbstractRuleClass
 * @package App\Poker\Rules
 */
abstract class AbstractRuleClass implements RuleInterface
{
    /**
     * to calculate if cards are in consecutive order (assuming that cards will be always stored
     * as ordered list from biggest to smallest element). Because it calculates distance
     * from existing to given card, that means that for consecutive cards it will
     * return a list of -1's. It's quite crucial to have the same
     * implementation for all instaces.
     * @param RuleInterface $other
     * @return int
     */
    public function distance(RuleInterface $other): int
    {
        return $this->weight() - $other->weight();
    }

    /**
     * Placeholder function for now
     * @param HandInterface $firstHand
     * @param HandInterface $secondHand
     * @return HandInterface
     */
    public function resolve(HandInterface $firstHand, HandInterface $secondHand): ?HandInterface
    {
        // TODO: Implement resolve() method.
        return $secondHand;
    }
}