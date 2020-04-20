<?php


namespace App\Poker\Rules;



use App\Poker\Contracts\CardInterface;
use App\Poker\Contracts\HandInterface;

class HighCardRule extends AbstractRuleClass
{

    /**
     * None of rules with higher rank can be applied.
     * Will look for
     * @param HandInterface $hand
     * @return bool
     */
    public function applies(HandInterface $hand): bool
    {
        $originalLength = $hand->getCards()->count();
        // Will group cards by their rank
        $clusteredCards = $hand->getCards()->cluster(function(CardInterface $card) {
            return array($card->getRank(), true);
        });

        $consecutiveLength = $hand->getCards()->applyWithPrevious(function(CardInterface $previous, CardInterface $current) {
           return $current->compare($previous);
        })->filter(function (int $distance) {
            return 1 === $distance || 0 === $distance;
        })->count();

        // There are no pairs and not all are consecutive
        return $originalLength === $clusteredCards->count() && $consecutiveLength < $originalLength -1;
    }

    /**
     * This is lowest rank rule
     * @return int
     */
    public function weight(): int
    {
        return 1;
    }
}
