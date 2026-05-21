<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactSetting extends Model
{
    protected $guarded = [];

    public function contacts()
    {
        return $this->hasMany(ContactPerson::class)->orderBy('sort_order', 'asc');
    }
}
