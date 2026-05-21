<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SditSetting extends Model
{
    protected $guarded = [];

    public function programs()
    {
        return $this->hasMany(SditProgram::class);
    }

    public function advantages()
    {
        return $this->hasMany(SditAdvantage::class);
    }

    public function galleries()
    {
        return $this->hasMany(SditGallery::class);
    }

    public function achievements()
    {
        return $this->hasMany(SditAchievement::class);
    }
}
