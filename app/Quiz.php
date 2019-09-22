<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = [
        'id',
        'title',
        'desc',
        'nQs',
        'author_id',
        'start_on',
        'duration',//in minute
        'nHit'
    ];
    protected $table = 'quizzes';
}
