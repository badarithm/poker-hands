<?php


namespace App\Poker;

use App\Poker\Contracts\HandInterface;
use App\Poker\Contracts\MatchInterface;
use App\Poker\Helpers\ExtendedSplFixedArray;
use App\Poker\Rules\FiveOfAKindRule;
use App\Poker\Rules\FlushRule;
use App\Poker\Rules\FourOfAKindRule;
use App\Poker\Rules\FullHouseRule;
use App\Poker\Rules\HighCardRule;
use App\Poker\Rules\OnePairRule;
use App\Poker\Rules\RoyalFlushRule;
use App\Poker\Rules\StraightFlushRule;
use App\Poker\Rules\StraightRule;
use App\Poker\Rules\ThreeOfAKindRule;
use App\Poker\Rules\TwoPairRule;
use Illuminate\Support\Facades\Log;
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
        RoyalFlushRule::class,
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
        $this->resetHands();
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
        array_push($this->hands, $hand);
    }

    /**
     * @return HandInterface
     */
    public function pickWinningHand(): ?HandInterface
    {
        // Initiate arrays to store results.
        $playerStatus = array();
        foreach ($this->hands as $key => $hand) {
            $playerStatus[$key] = array();
        }

        foreach ($this->ruleQueue as $ruleInstance)
        {
            foreach ($this->hands as $key => $hand) {
                if ($ruleInstance->applies($hand)) {
                    array_push($playerStatus[$key], $ruleInstance->weight());
                }
            }

            $winningRules = array();
            foreach ($this->hands as $key => $hand) {
                if (!empty($playerStatus[$key])) {
                    // select highest winning rule
                    $winningRules[$key] = max($playerStatus[$key]);
                }
            }

            if (!empty($winningRules)) {
                if (1 === count($winningRules)) {
                    foreach ($winningRules as $key => $value) {
                     return $this->hands[$key];
                    }
                } else {
                    $selectedHandKey = null;
                    $selectedHandValue = null;
                    foreach ($this->hands as $key => $value) {
                        if (null === $selectedHandKey) {
                            $selectedHandKey = $key;
                            $selectedHandValue = $value;
                        } else {
                            if ($selectedHandValue > $value) {
                                return $this->hands[$key];
                            } elseif ($selectedHandValue < $value) {
                                return $this->hands[$selectedHandKey];
                            } else {
                                // They are equal
                                return $this->ruleQueue[$value]->resolve($this->hands[0], $this->hands[1]);
                            }
                        }
                    }
                }
            }
        }
        return null;
    }

    public function resetHands(): void
    {
        $this->hands = array();
    }
}
