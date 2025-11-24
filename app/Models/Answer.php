<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'topic_id',
        'user_id',
        'question_id',
        'user_answer',
        'answer_exp'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
