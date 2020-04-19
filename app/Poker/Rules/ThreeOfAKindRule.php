<?php


namespace App\Poker\Rules;


use App\Poker\Contracts\CardInterface;
use App\Poker\Contracts\HandInterface;
use App\Poker\Contracts\RuleInterface;
use App\Poker\Helpers\SplFixedArrayExtensionInterface;

class ThreeOfAKindRule extends AbstractRuleClass
{

    /**
     * Three cards are of the same rank and two other cards have different rank.
     * Suit in this case doesn't really matter
     * @param HandInterface $hand
     * @return bool
     */
    public function applies(HandInterface $hand): bool
    {
        $cluster = $hand->getCards()->cluster(function(CardInterface $card) {
           return array($card->getRank(), true);
        });

        return 3 === $cluster->count() && $cluster->filter(function(SplFixedArrayExtensionInterface $collection) {
            $length = $collection->count();
            return 1 === $length || 3 === $length;
        });
    }

    public function weight(): int
    {
        return 4;
    }
}
