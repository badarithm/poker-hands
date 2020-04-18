<?php


namespace App\Poker\Rules;


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
        // TODO: Implement applies() method.
    }

    public function weight(): int
    {
        return 0;
    }
}
