<?php

namespace App\Companies\Observers;

use App\Companies\ManagerCompany;
use Illuminate\Database\Eloquent\Model;

class ManagerCompanyObserver
{

    public function creating(Model $model)
    {
        $managerCompany = app(ManagerCompany::class);

        $identify = $managerCompany->getCompanyIdentify();

        if ($identify) {
            $model->company_id = $identify;
        }
    }
}