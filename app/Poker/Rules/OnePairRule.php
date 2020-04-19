<?php


namespace App\Poker\Rules;



use App\Poker\Contracts\CardInterface;
use App\Poker\Contracts\HandInterface;
use App\Poker\Helpers\SplFixedArrayExtensionInterface;

class OnePairRule extends AbstractRuleClass
{

    /**
     * Group cards by rank, there should be only two cards matching
     * @param HandInterface $hand
     * @return bool
     */
    public function applies(HandInterface $hand): bool
    {
        $cluster = $hand->getCards()->cluster(function(CardInterface $card) {
            return array($card->getRank(), true);
        });

        return 4 === $cluster->count() && 4 === $cluster->filter(function(SplFixedArrayExtensionInterface $collection) {
                $length = $collection->count();
                return 1 === $length || 2 === $length;
            })->count();

    }

    public function weight(): int
    {
        return 2;
    }
}
