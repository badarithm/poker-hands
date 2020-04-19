<?php

namespace App\Models;

use App\Models\Game\PokerMatch;
use App\Models\Games\PokerHand;
use Highlight\Mode;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(new class implements Scope {

            public function apply(Builder $builder, Model $model)
            {
                return $builder->withCount('victories');
            }
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function matches(): HasMany
    {
        return $this->hasMany(PokerMatch::class, 'user_id', 'id');
    }

    public function victories(): HasMany
    {
        return $this->matches()->whereHas('winningHand', function($handQuery) {
            $handQuery->where('belongs_to_user', 1);
        });
    }
}
