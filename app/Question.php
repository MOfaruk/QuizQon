<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'quiz_id',
        'desc',
        'option1',
        'option2',
        'option3',
        'option4',
        'correct',
    ];

    protected $table = 'questions';
}
