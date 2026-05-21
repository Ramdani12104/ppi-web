<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class PesantrenProgram extends Model
{
    protected $table = 'programs';
    protected $guarded = [];

    protected static function booted()
    {
        static::addGlobalScope('type', function (Builder $builder) {
            $builder->where('type', 'Pesantren');
        });

        static::creating(function ($model) {
            $model->type = 'Pesantren';
        });
    }
}
