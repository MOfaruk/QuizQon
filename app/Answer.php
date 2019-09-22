<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'user_id',
        'quiz_id',
        'correct',
        'wrong',
        'unattempted',
        'score',
        'ans_json'
    ];
}
