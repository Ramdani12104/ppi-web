<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaranaGallery extends Model
{
    protected $guarded = [];

    public function setting()
    {
        return $this->belongsTo(SaranaSetting::class, 'sarana_setting_id');
    }
}
