<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];
}
