<?php

namespace App\Companies;

use App\Models\Company;

class ManagerCompany
{    
        
    /**
     * getCompanyIdentify
     *
     */
    public function getCompanyIdentify()
    {
        return auth()->check() ? auth()->user()->company_id : '';
    }
    
    /**
     * getCompany
     *
     */
    public function getCompany()
    {
        return auth()->check() ? auth()->user()->company : '';
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