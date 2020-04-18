<?php


namespace App\Poker\Rules;

use App\Poker\Contracts\CardInterface;
use App\Poker\Contracts\HandInterface;

/**
 * All cards have same suit, and rank decreases consequentialy by 1
 * Class StraightFlushRule
 * @package App\Poker\Rules
 */
class StraightFlushRule extends AbstractRuleClass
{
    /**
     * If all cards are the same suit and consequential rank
     * @param Hand $hand
     * @return bool
     */
    public function applies(HandInterface $hand): bool
    {
        $cards = $hand->getCards();
        // if suit is matching, then it has to be same as the first one
        $match = $cards[0];
        $matching = array_filter($cards, function(CardInterface $card) use ($match) {
            return $card->getSuit() === $match->getsuit();
        });
        if (count($cards) === count($matching)) {

        }
        return false;
    }

    public function weight(): int
    {
        return 9;
    }
}
