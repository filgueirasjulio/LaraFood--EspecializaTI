<?php

namespace App\Services;

use App\Models\Plan;
use Illuminate\Support\Str;

class CompanieService
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

        $companie = $this->storeCompanie();
        $user =  $this->storeUser($companie);

        return $user;
    }   
    
    /**
     * storeCompanie
     *
     * @return void
     */
    public function storeCompanie()
    {
        $data = $this->data;
        
        return $this->plan->companies()->create([
            'cnpj'=> $data['cnpj'],
            'name' => $data['companie'],
            'email' => $data['email'],
            'subscription' => now(),
            'expires_at' => now()->addDays(7)
          ]);   
    }
    
    /**
     * storeUser
     *
     * @param  mixed $companie
     * @return void
     */
    public function storeUser($companie)
    {
        $data = $this->data;
        
        $user = $companie->users()->create([
            'name' =>   $data['name'],
            'email' =>  $data['email'],
            'password' => bcrypt($data['password'])
          ]);

        return $user;
    }
}