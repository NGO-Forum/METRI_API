<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterestRegistration extends Model
{
    protected $fillable = [
        'full_name',
        'organization',
        'role_position',
        'email',
        'phone',
        'province',
        'interests',
        'consent',
    ];

    protected $casts = [
        'interests' => 'array',
        'consent' => 'boolean',
    ];
}
