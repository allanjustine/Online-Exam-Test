<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempAnswer extends Model
{
    protected $fillable = [
        'topic_id',
        'question_id',
        'question',
        'choices',
        'set',
        'question_img',
        'user_id',
        'user_answer',
        'answer_exp',
        'index',
        'type',
    ];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
