<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationalLevel extends Model
{
    protected $guarded = [];

    protected $casts = [
        'profile_content' => 'array',
        'programs' => 'array',
        'facilities' => 'array',
        'gallery' => 'array',
    ];
}
