<?php

namespace App\Companies\Traits;

use App\Companies\Observers\ManagerCompanyObserver;

trait CompanyTrait
{    
    /**
     * boot
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::observe(ManagerCompanyObserver::class);
    }
}