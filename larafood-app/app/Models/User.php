<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
        
    /**
     * company
     *
     * @return void
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    
    /**
     * search
     *
     * @param  mixed $filter
     * @return void
     */
    public function search($filter = null)
    {
        $results = $this->orWhere('name', 'LIKE', "%{$filter}%")
                        ->orWhere('email', 'LIKE', "%{$filter}%")
                        ->paginate();
        return $results;
    }
}
