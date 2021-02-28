<?php

namespace App\Companies\Traits;

use App\Companies\Observers\ManagerCompanyObserver;
use App\Companies\Scopes\CompanyScope;

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

        static::addGlobalScope(new CompanyScope);
    }
}