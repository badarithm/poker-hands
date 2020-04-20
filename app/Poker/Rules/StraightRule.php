<?php


namespace App\Poker\Rules;


use App\Poker\Contracts\CardInterface;
use App\Poker\Contracts\HandInterface;
use App\Poker\Contracts\RuleInterface;

class StraightRule extends AbstractRuleClass
{

    /**
     * Ranks are consecutive, but has more than one suit in a set
     * @param HandInterface $hand
     * @return bool
     */
    public function applies(HandInterface $hand): bool
    {
        $numberOfConsecutiveCards = $hand->getCards()->applyWithPrevious(function(CardInterface $previous, CardInterface $current) {
            return $current->distance($previous);
        })->filter(function (int $distance) {
            return -1 === $distance;
        })->count();

        $numberOfDifferentSuits = $hand->getCards()->cluster(function(CardInterface $card) {
            return [$card->getSuit(), true];
        })->count();

        return 1 < $numberOfDifferentSuits && $numberOfConsecutiveCards === $hand->getCards()->count() - 1;
    }

    public function weight(): int
    {
        return 5;
    }
}
