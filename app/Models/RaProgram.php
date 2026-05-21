<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RaProgram extends Model
{
    protected $guarded = [];

    public function raSetting()
    {
        return $this->belongsTo(RaSetting::class);
    }
}
