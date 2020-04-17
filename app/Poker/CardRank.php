<?php


namespace App\Poker;


use App\Poker\Contracts\CardRankInterface;
use App\Poker\Rules\CardInterface;

/**
 * Need a comparable class for successive card checks, ordering on insertion where cards
 * have to be compared in groups. For numeric comparison will use base-14 numbers
 * Class CardRank
 * @package App\Poker
 */
class CardRank implements CardRankInterface
{
    const CONVERSION_RULES = array(
        'J' => 11,
        'Q' => 12,
        'K' => 13,
        'A' => 14,
    );

    private $rank = null;

    /**
     * Need to store rank as a number. Since it can be just a limited number of letters (A, K, Q, J) + 10 - 2 numbers
     * will use base conversion with
     * CardRank constructor.
     * @param string $rank
     */
    public function __construct(string $rank)
    {
        if (ctype_digit($rank)) {
            $this->rank = (int) $rank;
        } else {
            $this->rank = static::CONVERSION_RULES[$rank];
        }
    }

    public function getRank(): int
    {
        return $this->rank;
    }

    /**
     *
     * @param CardRank $otherRank
     * @return int
     */
    public function distance(CardRankInterface $otherRank): int
    {
        return $this->getRank() - $otherRank->getRank();
    }

    public function isSuccessive(CardRankInterface $otherRank): bool
    {
        return 1 === $this->distance($otherRank);
    }

}
