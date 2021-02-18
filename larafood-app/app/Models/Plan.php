<?php

namespace App\Models;

use App\Models\Profile;
use App\Models\Company;
use App\Models\DetailPlan;
use Illuminate\Database\Eloquent\Model;
use App\Traits\SearchNameDescriptionTrait;

class Plan extends Model
{
    use SearchNameDescriptionTrait;
    
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = ['name', 'url', 'price', 'description'];
    
    /**
     * details
     *
     * @return void
     */
    public function details()
    {
        return $this->hasMany(DetailPlan::class);
    }
    
    /**
     * search
     *
     * @param  mixed $filter
     * @return void
     */
    public function search($filter = null)
    {
        $results = $this->SearchNameDescription($filter);
        
        return $results;
    }
    
    /**
     * profiles
     *
     * @return void
     */
    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }
    
    /**
     * companies
     *
     * @return void
     */
    public function companies()
    {
        return $this->hasMany(Company::class);
    }

    /**
     * profiles linked with this plan
     *
     * @param  mixed $filter
     * @return void
     */
    public function profilesLinked($filter = null) 
    {
        $plans = Profile::whereIn('profiles.id', function($query){
            $query->select('plan_profile.profile_id');
            $query->from('plan_profile');
            $query->whereRaw("plan_profile.plan_id={$this->id}");
        })
            ->where(function($queryFilter) use ($filter) {
               if($filter) {
                    $queryFilter->where('profiles.name', 'LIKE', "%{$filter}%");
               }
            })
            ->latest()
            ->paginate();

        return $plans;
    }
}
