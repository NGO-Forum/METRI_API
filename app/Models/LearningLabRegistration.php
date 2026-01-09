<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LearningLabRegistration extends Model
{
    protected $fillable = [
        'learning_lab_id',
        'full_name',
        'organization',
        'role_position',
        'email',
        'phone',
        'province',
        'is_ngof_member',
        'ngo_name',
        'payment_percentage',
        'special_needs',
        'consent',
    ];

    protected $casts = [
        'is_ngof_member' => 'boolean',
        'consent' => 'boolean',
    ];
}
