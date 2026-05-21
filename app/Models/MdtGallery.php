<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MdtGallery extends Model
{
    protected $guarded = [];

    public function mdtSetting()
    {
        return $this->belongsTo(MdtSetting::class);
    }
}
