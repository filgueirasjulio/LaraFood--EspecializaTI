<?php

namespace App\Services;

use App\Models\Plan;

class CompanyService
{    
    private $plan, $data = [];
    
    /**
     * @param Plan $plan
     * @param array $data
     * 
     * @return [type]
     */
    public function make(Plan $plan, array $data)
    {
        $this->plan = $plan;
        $this->data = $data;

        $company = $this->storeCompany();
        $user =  $this->storeUser($company);

        return $user;
    }   
    
    /**
     * @return [type]
     */
    public function storeCompany()
    {
        $data = $this->data;
        
        return $this->plan->companies()->create([
            'cnpj'=> $data['cnpj'],
            'name' => $data['company'],
            'email' => $data['email'],
            'subscription' => now(),
            'expires_at' => now()->addDays(7)
          ]);   
    }

    /**
     * @param mixed $company
     * 
     * @return [type]
     */
    public function storeUser($company)
    {
        $data = $this->data;
        
        $user = $company->users()->create([
            'name' =>   $data['name'],
            'email' =>  $data['email'],
            'password' => bcrypt($data['password'])
          ]);

        return $user;
    }
}