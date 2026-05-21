<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaranaSetting extends Model
{
    protected $guarded = [];

    public function facilities()
    {
        return $this->hasMany(SaranaFacility::class);
    }

    public function galleries()
    {
        return $this->hasMany(SaranaGallery::class);
    }
}
