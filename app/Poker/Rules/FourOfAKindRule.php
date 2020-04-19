<?php


namespace App\Poker\Rules;


use App\Poker\Contracts\CardInterface;
use App\Poker\Contracts\HandInterface;
use App\Poker\Contracts\RuleInterface;
use App\Poker\Helpers\SplFixedArrayExtensionInterface;

class FourOfAKindRule extends AbstractRuleClass
{
    /**
     * @param Hand $hand
     * @return bool
     */
    public function applies(HandInterface $hand): bool
    {
        return 2 === $hand->getCards()->cluster(function(CardInterface $card) {
           return array($card->getRank(), true);
        })->filter(function(SplFixedArrayExtensionInterface $cluster) {
            $length = $cluster->count();
            return 1 === $length || 4 === $length;
        })->count();
    }

    public function weight(): int
    {
        return 9;
    }
}
