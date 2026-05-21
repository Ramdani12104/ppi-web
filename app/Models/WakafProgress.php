<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WakafProgress extends Model
{
    protected $table = 'wakaf_progresses';

    protected $guarded = [];

    public function setting()
    {
        return $this->belongsTo(WakafSetting::class, 'wakaf_setting_id');
    }
}
