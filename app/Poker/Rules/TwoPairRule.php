<?php


namespace App\Poker\Rules;

use App\Poker\Contracts\CardInterface;
use App\Poker\Contracts\HandInterface;
use App\Poker\Contracts\RuleInterface;
use App\Poker\Helpers\SplFixedArrayExtensionInterface;

class TwoPairRule extends AbstractRuleClass
{

    public function applies(HandInterface $hand): bool
    {
        $cluster = $hand->getCards()->cluster(function(CardInterface $card) {
           return array($card->getRank(), true);
        });

        return 3 === $cluster->count() && 3 === $cluster->filter(function(SplFixedArrayExtensionInterface $collection) {
                $length = $collection->count();
                return 1 === $length || 2 === $length;
            })->count();
    }

    public function weight(): int
    {
        return 3;
    }
}
