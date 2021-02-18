<?php

namespace App\Services;

use App\Models\Plan;

class CompanyService
{    
    private $plan, $data = [];
    
    /**
     * make
     *
     * @param  mixed $plan
     * @param  mixed $data
     * @return void
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
     * storeCompanie
     *
     * @return void
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
     * storeUser
     *
     * @param  mixed $company
     * @return void
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