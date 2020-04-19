<?php


namespace App\Poker\Rules;


use App\Poker\Contracts\CardInterface;
use App\Poker\Contracts\RuleInterface;
use App\Poker\Contracts\HandInterface;
use App\Poker\Helpers\SplFixedArrayExtensionInterface;
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
     * Will take first four and last four items (again, assuming here that collection
     * in question is already ordered.
     * @inheritDoc
     */
    public function applies(HandInterface $hand): bool
    {
        $tail = $hand->getCards()->tail();
        $tailInverse = $hand->getCards()->tailInverse();
        // if either one of them
        $ruleApplies = false;
    }

    public function weight(): int
    {
        return 10;
    }

    public function resolve(HandInterface $firstHand, HandInterface $secondHand): ?HandInterface
    {
        if ($this->applies($firstHand)) {
            return $firstHand;
        } elseif ($this->applies($secondHand)) {
            return $secondHand;
        } else {
            return null;
        }
    }
}
