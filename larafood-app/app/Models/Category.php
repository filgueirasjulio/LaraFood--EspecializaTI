<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Companies\Observers\ManagerCompanyObserver;

class Category extends Model
{
    protected $fillable = ['name', 'url', 'description'];

    protected static function boot()
    {
        parent::boot();

        static::observe(ManagerCompanyObserver::class);
    }
}
