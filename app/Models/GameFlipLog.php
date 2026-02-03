<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameFlipLog extends Model
{
    protected $fillable = [
        'card_id',
        'matching_pair_id',
        'matched_with',
    ];

    public function matchingPair() {
        return $this->belongsTo(MatchingPair::class);
    }

    public function card() {
        return $this->belongsTo(Card::class);
    }
}
