<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatchingPair extends Model
{
    protected $fillable = [
        'name',
        'difficulty',
    ];

    public function cards() {
        return $this->hasMany(Card::class);
    }

    public function gameHistories() {
        return $this->hasMany(GameHistory::class);
    }
}
