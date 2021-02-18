<?php

namespace App\Models;

use App\Models\Plan;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use App\Traits\SearchNameDescriptionTrait;

class Profile extends Model
{
    use SearchNameDescriptionTrait;
    
    protected $fillable = ['name', 'description'];

    public function search($filter = null)
    {
        $results = $this->SearchNameDescription($filter);
        
        return $results;
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function plans()
    {
        return $this->belongsToMany(Plan::class);
    }

    /**
     * permissions not linked with this profile
     */
    public function permissionsAvailable($filter = null)
    {
        $permissions = Permission::whereNotIn('permissions.id', function($query){
            $query->select('permission_profile.permission_id');
            $query->from('permission_profile');
            $query->whereRaw("permission_profile.profile_id={$this->id}");
        })
            ->where(function($queryFilter) use ($filter) {
               if($filter) {
                    $queryFilter->where('permissions.name', 'LIKE', "%{$filter}%");
               }
            })
            ->latest()
            ->paginate();

        return $permissions;
    }

    /**
     * plans not linked with this profile
     */
    public function plansAvailable($filter = null)
    {
        $plans = Plan::whereNotIn('plans.id', function($query){
            $query->select('plan_profile.plan_id');
            $query->from('plan_profile');
            $query->whereRaw("plan_profile.profile_id={$this->id}");
        })
            ->where(function($queryFilter) use ($filter) {
               if($filter) {
                    $queryFilter->where('plans.name', 'LIKE', "%{$filter}%");
               }
            })
            ->latest()
            ->paginate();

        return $plans
        ;
    }

    /**
     * permissions linked with this profile
     */
    public function permissionsLinked($filter = null) 
    {
        $permissions = Permission::whereIn('permissions.id', function($query){
            $query->select('permission_profile.permission_id');
            $query->from('permission_profile');
            $query->whereRaw("permission_profile.profile_id={$this->id}");
        })
            ->where(function($queryFilter) use ($filter) {
               if($filter) {
                    $queryFilter->where('permissions.name', 'LIKE', "%{$filter}%");
               }
            })
            ->latest()
            ->paginate();

        return $permissions;
    }

    /**
     * permissions linked with this profile
     */
    public function plansLinked($filter = null) 
    {
        $plans = Plan::whereIn('plans.id', function($query){
            $query->select('plan_profile.plan_id');
            $query->from('plan_profile');
            $query->whereRaw("plan_profile.profile_id={$this->id}");
        })
            ->where(function($queryFilter) use ($filter) {
               if($filter) {
                    $queryFilter->where('plans.name', 'LIKE', "%{$filter}%");
               }
            })
            ->latest()
            ->paginate();

        return $plans;
    }
}
