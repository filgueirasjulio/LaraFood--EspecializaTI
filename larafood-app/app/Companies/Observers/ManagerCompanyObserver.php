<?php

namespace App\Companies\Observers;

use App\Companies\ManagerCompany;
use Illuminate\Database\Eloquent\Model;

class ManagerCompanyObserver
{

    public function creating(Model $model)
    {
        $managerCompany = app(ManagerCompany::class);

        $model->company_id = $managerCompany->getCompanyIdentify();
    }
}