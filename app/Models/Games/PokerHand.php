<?php

namespace App\Models\Games;

use App\Models\Game\PokerMatch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PokerHand extends Model
{

    protected $table = 'poker_hand';

    public function match(): BelongsTo
    {
        return $this->belongsTo(PokerMatch::class, 'id', 'match_id');
    }
}
