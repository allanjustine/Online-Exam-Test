<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $table = 'topics';
    protected $fillable = [
        'title',
        'slug',
        'per_q_mark',
        'description',
        'timer',
        'set',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function question()
    {
        return $this->hasMany(Question::class);
    }

    public function answer()
    {
        return $this->hasMany(Answer::class);
    }

    public function temp()
    {
        return $this->hasMany(TempAnswer::class);
    }
}
