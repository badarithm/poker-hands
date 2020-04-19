<?php

namespace App\Models\Games;

use App\Models\Game\PokerMatch;
use App\Poker\Card;
use App\Poker\Contracts\CardInterface;
use App\Poker\Contracts\HandInterface;
use App\Poker\Contracts\SplFixedArray;
use App\Poker\Helpers\ExtendedSplFixedArray;
use App\Poker\Helpers\SplFixedArrayExtensionInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PokerHand extends Model implements HandInterface
{
    use SoftDeletes;

    protected $cards = null;

    protected $table = 'poker_hand';

    protected $fillable = ['match_id', 'cards', 'belongs_to_user', 'is_winner'];

    public function match(): BelongsTo
    {
        return $this->belongsTo(PokerMatch::class, 'id', 'match_id');
    }

    public function addCard(CardInterface $card): void
    {
        // I think there is no scenario for this currently.
    }

    public function getCards(): SplFixedArrayExtensionInterface
    {
        if (null === $this->cards) {
            $cards = explode(' ', $this->cards);
            $cardArray = new ExtendedSplFixedArray(count($cards));
            foreach($cards as $key => $card) {
                $cardArray[$key] = new Card($card);
            }
            $this->cards = $cardArray;
        }
        return $this->cards;
    }

    public function max(): int
    {
        return 5;
    }
}
