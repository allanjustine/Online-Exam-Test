<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'topic_id',
        'question',
        'choices',
        'answer',
        'question_img',
        'type',
        'underline'
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function temp()
    {
        return $this->hasMany(TempAnswer::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
