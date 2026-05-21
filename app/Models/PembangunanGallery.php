<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PembangunanGallery extends Model
{
    protected $guarded = [];

    public function setting()
    {
        return $this->belongsTo(PembangunanSetting::class, 'pembangunan_setting_id');
    }
}
