<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
        'pair_number',
        'position',
        'matching_pair_id',
        'card_template_id'
    ];
    public function matchingPair() {
        return $this->belongsTo(MatchingPair::class);
    }

    public function cardTemplate() {
        return $this->belongsTo(CardTemplate::class);
    }

    public function gameHistories() {
        return $this->hasMany(GameHistory::class);
    }
}
