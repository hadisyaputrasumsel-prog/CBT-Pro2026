<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable = [
        'name',
        'nim',
        'status',
        'score',
        'questions_list',
        'tab_results',
    ];

    protected $casts = [
        'questions_list' => 'array',
        'tab_results' => 'array',
    ];
}
