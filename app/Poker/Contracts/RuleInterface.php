<?php


namespace App\Poker\Contracts;


use App\Poker\Contracts\HandInterface;

interface RuleInterface
{
    /**
     * To check if hand conforms to a rule
     * @param HandInterface $hand
     * @return bool
     */
    public function applies(HandInterface $hand): bool;

    /**
     * To determine which rule has a higher precedence.
     * Likely weight is already enough for comparison.
     * @param RuleInterface $other
     * @return int
     */
    public function distance(RuleInterface $other): int;

    /**
     * To be used for comparison. Since two RuleInterface weights cannot be mutually
     * exclusive, technically there should also be some method to resolve that conflict.
     * @return int
     */
    public function weight(): int;
}
