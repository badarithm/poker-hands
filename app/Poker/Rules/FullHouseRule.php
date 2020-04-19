<?php


namespace App\Poker\Rules;


use App\Poker\Contracts\CardInterface;
use App\Poker\Contracts\HandInterface;
use App\Poker\Contracts\RuleInterface;
use App\Poker\Helpers\SplFixedArrayExtensionInterface;

class FullHouseRule extends AbstractRuleClass
{

    /**
     * @param HandInterface|Hand $hand
     * @return bool
     */
    public function applies(HandInterface $hand): bool
    {
        $clusters = $hand->getCards()->cluster(function (CardInterface $card) {
            return [$card->getRank(), true];
        });

        // have to check if there are only two clusters
        // and then have to check if distribution is 2 and 3
        // aka not 5 + 0 || 4 + 1
        return 2 === $clusters->count() && 2 === $clusters->filter(function (SplFixedArrayExtensionInterface $collection) {
                $length = $collection->count();
                return 2 === $length || 3 === $length;
            })->count();
    }

    public function weight(): int
    {
        return 7;
    }
}
