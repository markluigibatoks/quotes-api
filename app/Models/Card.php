<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
        'position',
        'is_matched',
        'matching_pair_id',
        'card_template_id'
    ];

    protected $casts = [
        'is_matched' => 'boolean'
    ];

    public function matchingPair() {
        return $this->belongsTo(MatchingPair::class);
    }

    public function cardTemplate() {
        return $this->belongsTo(CardTemplate::class);
    }

    public function gameFlipLogs() {
        return $this->hasMany(GameFlipLog::class);
    }
}
