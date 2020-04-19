<?php

namespace App\Models\Game;

use App\Models\Games\PokerHand;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PokerMatch extends Model
{
    use SoftDeletes;

    protected $table = 'poker_match';

    protected $fillable = ['user_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function hands(): HasMany
    {
        return $this->hasMany(PokerHand::class, 'match_id', 'id');
    }
}
