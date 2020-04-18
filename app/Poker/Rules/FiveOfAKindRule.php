<?php


namespace App\Poker\Rules;


use App\Poker\Contracts\CardInterface;
use App\Poker\Contracts\RuleInterface;
use App\Poker\Contracts\HandInterface;
use \SplFixedArray;
/**
 * Applies when four cards have the same weight or four and the wild card
 * In this case have to sort given hand and compare first four and last four
 * cards for distance of 0. Not so sure about the wild card.
 * Class FiveOfAKindRule
 * @package App\Poker\Rules
 */
class FiveOfAKindRule extends AbstractRuleClass
{

    /**
     * Tail of original or it's inverse must have distances of 0
     * @inheritDoc
     */
    public function applies(HandInterface $hand): bool
    {
        $excerptLength = $hand->max() - 1;
        $tail = array_slice($hand->getCards(),1, $excerptLength);
        $inverseTail = array_slice($hand->getCards(), 0, $excerptLength);
        return (0 === $this->sum($tail)) || (0 === $this->sum($inverseTail));
    }

    public function weight(): int
    {
        return 10;
    }

    /**
     * To calculate distances between cards in subsets.
     * In array has only one element, sum of distances is 0, because it's a point
     * @param SplFixedArray $cards
     * @return int
     */
    protected function sum(SplFixedArray $cards): int
    {
        $sum = 0;
        $previous = null;
        foreach ($cards as $card) {
            if (null !== $previous) {
                $sum += $card->distance($previous);
            }
            $previous = $card;
        }
        return $sum;
    }
}
