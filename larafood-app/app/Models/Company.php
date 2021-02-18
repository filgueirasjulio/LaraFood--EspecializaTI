<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{    
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'uuid', 'cnpj', 'name', 'url', 'email', 'logo', 'active',
        'subscription', 'expires_at', 'subscription_id', 'subscription_active', 'subscription_suspended',
    ];
    
    /**
     * table
     *
     * @var string
     */
    protected $table = "companies";
    
    /**
     * users
     *
     * @return void
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
    
    /**
     * plan
     *
     * @return void
     */
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
