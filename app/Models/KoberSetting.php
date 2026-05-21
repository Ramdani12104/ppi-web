<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KoberSetting extends Model
{
    protected $guarded = [];

    public function programs()
    {
        return $this->hasMany(KoberProgram::class);
    }

    public function advantages()
    {
        return $this->hasMany(KoberAdvantage::class);
    }

    public function galleries()
    {
        return $this->hasMany(KoberGallery::class);
    }
}
