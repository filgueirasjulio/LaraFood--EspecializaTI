<?php

namespace App\Observers;

use App\Models\Companie;
use Illuminate\Support\Str;

class CompanieObserver
{
    /**
     * Handle the companie "creating" event.
     *
     * @param  \App\Models\Companie  $companie
     * @return void
     */
    public function creating(Companie $companie)
    {
        $companie->uuid = Str::uuid();
        $companie->url = Str::kebab($companie->name);
    }

    /**
     * Handle the companie "updating" event.
     *
     * @param  \App\Models\Companie  $companie
     * @return void
     */
    public function updating(Companie $companie)
    {
        $companie->uuid = Str::uuid();
        $companie->url = Str::kebab($companie->name);
    }
}
