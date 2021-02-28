<?php

namespace App\Companies\Scopes;

use App\Companies\ManagerCompany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class CompanyScope implements Scope
{    
    /**
     * apply
     *
     * @param  mixed $builder
     * @param  mixed $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $managerCompany = app(ManagerCompany::class);
        $builder->where('company_id', $managerCompany->getCompanyIdentify());
    }
}