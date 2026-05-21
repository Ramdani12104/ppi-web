<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeasiswaHistory extends Model
{
    protected $guarded = [];

    public function setting()
    {
        return $this->belongsTo(BeasiswaSetting::class, 'beasiswa_setting_id');
    }
}
