<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    protected $guarded = [];

    public function posts()
    {
        return $this->hasMany(NewsPost::class);
    }
}
