<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Verification extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'user_token','code',
    ];
}
