<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SditProgram extends Model
{
    protected $guarded = [];

    public function sditSetting()
    {
        return $this->belongsTo(SditSetting::class);
    }
}
