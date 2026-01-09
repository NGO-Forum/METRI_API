<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningLab extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'topic',
        'time',
        'format',
        'speakers',
        'is_published',
    ];
}
