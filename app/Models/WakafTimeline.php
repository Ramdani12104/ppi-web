<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WakafTimeline extends Model
{
    protected $guarded = [];

    public function setting()
    {
        return $this->belongsTo(WakafSetting::class, 'wakaf_setting_id');
    }
}
