<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameHistory extends Model
{
    protected $fillable = [
        'card_id',
        'matching_pair_id',
        'is_matched',
        'matched_with'
    ];

    protected $casts = [
        'is_matched' => 'boolean'
    ];

    public function matchingPair() {
        return $this->belongsTo(MatchingPair::class);
    }
}
