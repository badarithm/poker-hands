<?php


namespace App\Poker\Rules;

use App\Poker\Contracts\CardInterface;
use App\Poker\Contracts\HandInterface;

/**
 * All cards have same suit, and rank decreases consequentialy by 1
 * Class StraightFlushRule
 * @package App\Poker\Rules
 */
class StraightFlushRule extends AbstractRuleClass
{
    /**
     * If all cards are the same suit and consequential rank
     * @param Hand $hand
     * @return bool
     */
    public function applies(HandInterface $hand): bool
    {
        $cards = $hand->getCards();
        $expectedLength = $cards->count() - 1;
        // if suit is matching, then it has to be same as the first one
        $suitsMatch = $cards->applyWithPrevious(function(CardInterface $previous, CardInterface $current) {
          return $previous->getSuit() === $current->getSuit();
        })->filter(function(bool $match) {
            return $match;
        })->count() === $expectedLength;

        $ranksAreConsecutive = $cards->applyWithPrevious(function(CardInterface $previous, CardInterface $current) {
          return $current->compare($previous);
        })->filter(function(int $distance) {
            return -1 === $distance;
        })->count() === $expectedLength;

        return $suitsMatch && $ranksAreConsecutive;
    }

    public function weight(): int
    {
        return 9;
    }
}
