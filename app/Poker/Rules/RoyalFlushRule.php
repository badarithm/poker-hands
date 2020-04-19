<?php


namespace App\Poker\Rules;


use App\Poker\Contracts\CardInterface;
use App\Poker\Contracts\HandInterface;
use Illuminate\Support\Facades\Log;

class RoyalFlushRule extends AbstractRuleClass
{
    /**
     * Royal flush
     * @param HandInterface $hand
     * @return bool
     */
    public function applies(HandInterface $hand): bool
    {
        $cards = $hand->getCards();

        // there should be only one group of these
        $sameCardClusters = $cards->cluster(function(CardInterface $card) {
           return [$card->getSuit(), true];
        })->count();

        $consecutiveCards = $cards->applyWithPrevious(function(CardInterface $previous, CardInterface $current) {
            return $current->distance($previous);
        })->filter(function($dist) {
            return -1 !== $dist;
        })->count();

        // calculate all of their weight sum
        $totalWeight = $cards->map(function (CardInterface $card) {
            return $card->getRankNumber();
        })->sum();

        return $totalWeight === 60 && 4 === $consecutiveCards && 1 === $sameCardClusters;
    }

    public function weight(): int
    {
        return 10;
    }
}