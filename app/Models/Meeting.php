<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $casts = [
        'date_time' => 'datetime',
    ];

    protected $fillable = [
        'title',
        'organizer',
        'date_time',
        'participants'
    ];
}
