<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PembangunanSetting extends Model
{
    protected $guarded = [];
    protected $casts = [
        'bank_accounts' => 'array',
    ];

    public function projects()
    {
        return $this->hasMany(PembangunanProject::class)->orderBy('sort_order', 'asc');
    }

    public function histories()
    {
        return $this->hasMany(PembangunanHistory::class)->orderBy('sort_order', 'asc')->orderBy('year', 'desc');
    }

    public function galleries()
    {
        return $this->hasMany(PembangunanGallery::class)->orderBy('sort_order', 'asc');
    }
}
