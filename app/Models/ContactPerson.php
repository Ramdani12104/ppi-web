<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactPerson extends Model
{
    protected $guarded = [];

    public function setting()
    {
        return $this->belongsTo(ContactSetting::class, 'contact_setting_id');
    }
}
