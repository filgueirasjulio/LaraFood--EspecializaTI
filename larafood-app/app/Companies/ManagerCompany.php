<?php

namespace App\Companies;

use App\Models\Company;

class ManagerCompany
{    
        
    /**
     * getCompanyIdentify
     *
     * @return int
     */
    public function getCompanyIdentify():int
    {
        return auth()->user()->company_id;
    }
    
    /**
     * getCompany
     *
     * @return Company
     */
    public function getCompany(): Company
    {
        return auth()->user->company;
    }
        
    /**
     * isAdmin
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return in_array(auth()->user()->email, config('company.admins'));
    }
}