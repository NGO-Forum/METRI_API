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
        'link',
        'description',
        'speakers',
        'is_published',
    ];

    protected $casts = [
        'date' => 'date',
        'is_published' => 'boolean',
    ];

    /**
     * A learning lab has many registrations
     */
    public function registrations()
    {
        return $this->hasMany(LearningLabRegistration::class);
    }
}
