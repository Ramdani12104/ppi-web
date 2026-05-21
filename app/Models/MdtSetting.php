<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MdtSetting extends Model
{
    protected $guarded = [];

    public function programs()
    {
        return $this->hasMany(MdtProgram::class);
    }

    public function advantages()
    {
        return $this->hasMany(MdtAdvantage::class);
    }

    public function galleries()
    {
        return $this->hasMany(MdtGallery::class);
    }
}
