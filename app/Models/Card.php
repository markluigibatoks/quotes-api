<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    public function matchingPair() {
        return $this->belongsTo(MatchingPair::class);
    }
}
