<?php

namespace App\Models\Game;

use App\Models\Games\PokerHand;
use App\Models\User;
use App\Poker\Contracts\HandInterface;
use App\Poker\Contracts\MatchInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PokerMatch extends Model implements MatchInterface
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

    public function playerHand(): HasMany
    {
        return $this->hands()->where('belongs_to_user', 1);
    }

    public function opponentHand(): HasMany
    {
        return $this->hands()->where('belongs_to_user', 0);
    }

    public function winningHand(): HasMany
    {
        return $this->hands()->where('is_winner', 1);
    }

    // Adding some magic getters to show results in the dashboard page

    /**
     * @return string
     */
    public function getMatchIdAttribute(): string
    {
        return base_convert($this->id, 10, 36);
    }

    public function getPlayerCardsAttribute(): ?string
    {
        if ($this->playerHand->isNotEmpty()) {
            return $this->playerHand->first()->cards;
        }
        return null;
    }

    public function getOpponentCardsAttribute(): ?string
    {
        if ($this->opponentHand->isNotEmpty()) {
            return $this->opponentHand->first()->cards;
        }
        return null;
    }

    public function getWinnerAttribute(): ?string
    {
        if ($this->winningHand->isNotEmpty()) {
            if (1 === $this->winningHand->first()->user_id) {
                return 'Player';
            } else {
                return 'Opponent';
            }
        }

        return 'No Winners';
    }
}
