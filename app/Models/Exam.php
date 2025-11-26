<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table = 'exam';
    protected $fillable = [
        'user_id',
        'exam',
        'created_at',
        'updated_at',
        'started_at',
        'end_at',
        'sent_by',
        'violation',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
