<?php


namespace App\Poker\Contracts;

use App\Poker\Rules\FiveOfAKindRule;
use App\Poker\Rules\FlushRule;
use App\Poker\Rules\FourOfAKindRule;
use App\Poker\Rules\FullHouseRule;
use App\Poker\Rules\HighCardRule;
use App\Poker\Rules\OnePairRule;
use App\Poker\Rules\StraightFlushRule;
use App\Poker\Rules\StraightRule;
use App\Poker\Rules\ThreeOfAKindRule;
use App\Poker\Rules\TwoPairRule;
use \SplFixedArray;

/**
 * Class Match. Applies to given hands and determines winner
 * @package App\Poker\Contracts
 */
class Match implements MatchInterface
{
    const MAX_PLAYERS = 2;
    private $hands = null;

    private $applicableRules = array(
        FlushRule::class,
        FiveOfAKindRule::class,
        FourOfAKindRule::class,
        FullHouseRule::class,
        HighCardRule::class,
        OnePairRule::class,
        StraightFlushRule::class,
        StraightRule::class,
        ThreeOfAKindRule::class,
        TwoPairRule::class,
    );

    /**
     * Stack of rules that have to be applied
     * @var null
     */
    private $ruleQueue = null;

    /**
     * Match constructor. Initiates array for hands. Again, using fixed array, because size is known
     * in advance.
     */
    public function __construct()
    {
        $this->hands = new SplFixedArray(static::MAX_PLAYERS);
        $this->initiateRules();
    }

    private function initiateRules(): void
    {
        foreach ($this->applicableRules as $classReference) {
            $instance = new $classReference();
            $this->ruleQueue[$instance->weight()] = $instance;
        }
        // rule with highest weight should be applied earlier
        krsort($this->ruleQueue);
    }

    /**
     * @param HandInterface $hand
     */
    public function addHand(HandInterface $hand): void
    {
        $this->hands[] = $hand;
    }

    /**
     * @return HandInterface
     */
    public function pickWinningHand(): HandInterface
    {
        foreach ($this->ruleQueue as $ruleInstance)
        {
            $playerStatus = array();
            foreach ($this->hands as $key => $hand) {
                $playerStatus[$key] = $ruleInstance->applies($hand);
            }

            $numberOfWinners = array_filter($playerStatus, function($status) {
               return $status;
            });

            if (1 < $numberOfWinners) {
                return $ruleInstance->resolve($playerStatus[0], $playerStatus[1]);
            } elseif ($playerStatus[0]) {
                return $this->hands[0];
            } elseif ($this->hands[1]){
                return $this->hands[1];
            }
        }
    }
}
