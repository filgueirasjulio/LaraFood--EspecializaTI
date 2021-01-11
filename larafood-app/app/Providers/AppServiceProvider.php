<?php

namespace App\Providers;



use App\Models\{Plan, Companie};
use App\Observers\{PlanObserver, CompanieObserver};
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Plan::observe(PlanObserver::class);
        Companie::observe(CompanieObserver::class);
    }
}
