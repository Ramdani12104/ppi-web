<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeasiswaSetting extends Model
{
    protected $guarded = [];
    protected $casts = [
        'bank_accounts' => 'array',
    ];

    public function programs()
    {
        return $this->hasMany(BeasiswaProgram::class)->orderBy('sort_order', 'asc');
    }

    public function histories()
    {
        return $this->hasMany(BeasiswaHistory::class)->orderBy('sort_order', 'asc');
    }

    public function galleries()
    {
        return $this->hasMany(BeasiswaGallery::class)->orderBy('sort_order', 'asc');
    }
}
