<?php

namespace App\Models\Games;

use App\Models\Game\PokerMatch;
use App\Poker\Contracts\CardInterface;
use App\Poker\Contracts\HandInterface;
use App\Poker\Contracts\SplFixedArray;
use App\Poker\Helpers\SplFixedArrayExtensionInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PokerHand extends Model
{
    use SoftDeletes;

    protected $table = 'poker_hand';

    protected $fillable = ['match_id', 'cards', 'belongs_to_user', 'is_winner'];

    public function match(): BelongsTo
    {
        return $this->belongsTo(PokerMatch::class, 'id', 'match_id');
    }
}
