<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatchingPair extends Model
{
    protected $fillable = [
        'name',
        'difficulty',
    ];

    protected $casts = [
        'game_over' => 'boolean'
    ];

    public function cards() {
        return $this->hasMany(Card::class);
    }

    public function gameFlipLogs() {
        return $this->hasMany(GameFlipLog::class);
    }
}
