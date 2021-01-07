<?php

namespace App\Models;

use App\Models\Profile;
use App\Models\Companie;
use App\Models\DetailPlan;
use Illuminate\Database\Eloquent\Model;
use App\Traits\SearchNameDescriptionTrait;

class Plan extends Model
{
    use SearchNameDescriptionTrait;

    protected $fillable = ['name', 'url', 'price', 'description'];

    public function details()
    {
        return $this->hasMany(DetailPlan::class);
    }

    public function search($filter = null)
    {
        $results = $this->SearchNameDescription($filter);
        
        return $results;
    }

    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }

    
    public function companies()
    {
        return $this->hasMany(Companie::class);
    }

    /**
     * profiles linked with this plan
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
