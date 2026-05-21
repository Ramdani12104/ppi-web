<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WakafSetting extends Model
{
    protected $guarded = [];

    public function programs()
    {
        return $this->hasMany(WakafProgram::class)->orderBy('order');
    }

    public function timelines()
    {
        return $this->hasMany(WakafTimeline::class)->orderBy('order');
    }

    public function progresses()
    {
        return $this->hasMany(WakafProgress::class)->orderBy('order');
    }

    public function galleries()
    {
        return $this->hasMany(WakafGallery::class)->orderBy('order');
    }
}
