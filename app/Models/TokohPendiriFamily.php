<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TokohPendiriFamily extends Model
{
    protected $guarded = [];

    public function setting()
    {
        return $this->belongsTo(TokohPendiriSetting::class, 'tokoh_pendiri_setting_id');
    }
}
