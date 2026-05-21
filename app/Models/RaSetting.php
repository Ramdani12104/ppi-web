<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RaSetting extends Model
{
    protected $guarded = [];

    public function programs()
    {
        return $this->hasMany(RaProgram::class);
    }

    public function advantages()
    {
        return $this->hasMany(RaAdvantage::class);
    }

    public function galleries()
    {
        return $this->hasMany(RaGallery::class);
    }
}
