<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TokohPendiriSetting extends Model
{
    protected $guarded = [];

    public function families()
    {
        return $this->hasMany(TokohPendiriFamily::class);
    }

    public function timelines()
    {
        return $this->hasMany(TokohPendiriTimeline::class);
    }

    public function galleries()
    {
        return $this->hasMany(TokohPendiriGallery::class);
    }
}
