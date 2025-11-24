<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'color';
    protected $fillable = [
        'user_id',
        'profile_color'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
