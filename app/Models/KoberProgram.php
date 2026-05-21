<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KoberProgram extends Model
{
    protected $guarded = [];

    public function koberSetting()
    {
        return $this->belongsTo(KoberSetting::class);
    }
}
