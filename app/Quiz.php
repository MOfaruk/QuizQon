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
        'negativeMark',
        'author_id',
        'start_on',
        'duration',//in minute
        'thumbnail',
        'nHit',
        'status'
    ];
    protected $table = 'quizzes';
}
