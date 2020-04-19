<?php


namespace App\Poker\Rules;


use App\Poker\Contracts\CardInterface;
use App\Poker\Hand;
use App\Poker\Contracts\HandInterface;

class FlushRule extends AbstractRuleClass
{

    /**
     * @param Hand $hand
     * @return bool
     */
    public function applies(HandInterface $hand): bool
    {
        $expectedLength = $hand->getCards() - 1;
        return $expectedLength === $hand->getCards()->applyWithPrevious(function(CardInterface $previous, CardInterface $currrent) {
                return $previous->getSuit() === $currrent->getSuit();
            })->filter(function(bool $result) {
                return $result;
            })->count();
    }

    public function weight(): int
    {
        return 0;
    }
}
