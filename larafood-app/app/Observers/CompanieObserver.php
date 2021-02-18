<?php

namespace App\Observers;

use App\Models\Company;
use Illuminate\Support\Str;

class CompanieObserver
{
    /**
     * Handle the company "creating" event.
     *
     * @param  \App\Models\Company  $company
     * @return void
     */
    public function creating(Company $company)
    {
        $company->uuid = Str::uuid();
        $company->url = Str::kebab($company->name);
    }

    /**
     * Handle the company "updating" event.
     *
     * @param  \App\Models\Company  $company
     * @return void
     */
    public function updating(Company $company)
    {
        $company->uuid = Str::uuid();
        $company->url = Str::kebab($company->name);
    }
}
