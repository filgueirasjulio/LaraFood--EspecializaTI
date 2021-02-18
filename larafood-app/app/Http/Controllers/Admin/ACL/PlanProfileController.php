<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Models\Plan;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlanProfileController extends Controller
{
    
    private $plan, $profile;
    
    /**
     * __construct
     *
     * @param  mixed $plan
     * @param  mixed $profile
     * @return void
     */
    public function __construct(Plan $plan, Profile $profile)
    {
        $this->plan = $plan;
        $this->profile = $profile;
    }
    
    /**
     * plans
     *
     * @param  mixed $idProfile
     * @return void
     */
    public function plans($idProfile)
    {
        $profile = $this->profile->find($idProfile);
        if(!$profile) {
            return redirect()->back();
        }
      
        $plans = $profile->plans()->latest()->paginate();
        $filter = '';

        return view('admin.pages.profiles.plans.plans', compact('profile', 'plans', 'filter'));
    }
    
    /**
     * profiles
     *
     * @param  mixed $idPlan
     * @return void
     */
    public function profiles($idPlan)
    {
        $plan = $this->plan->find($idPlan);
        if (!$plan) {
            return redirect()->back();
        }

        $profiles = $plan->profiles()->latest()->paginate();
        $filter = '';

        return view('admin.pages.plans.profiles.profiles', compact('plan', 'profiles', 'filter'));
    }
    
    /**
     * plansAvailable
     *
     * @param  mixed $idProfile
     * @return void
     */
    public function plansAvailable($idProfile)
    {
        if(!$profile = $this->profile->find($idProfile)) {
            return redirect()->back();
        }

        $plans = $profile->plansAvailable();
        $filter = '';

        return view('admin.pages.profiles.plans.available', compact('profile', 'plans', 'filter'));
    }
    
    /**
     * attachPlansProfile
     *
     * @param  mixed $request
     * @param  mixed $idProfile
     * @return void
     */
    public function attachPlansProfile(Request $request, $idProfile)
    {
        if(!$profile = $this->profile->find($idProfile)) {
            return redirect()->back();
        }

        if(!$request->plans || count($request->plans) == 0) {
            return redirect()->back()
                             ->with('warning', 'Selecione pelo menos um plano!');
        }

        $profile->plans()->attach($request->plans);

        
        if(count($request->plans) == 1) {
            return redirect()
                ->route('profiles.plans', $profile->id)
                ->with('message', 'Plano vinculado com sucesso!');
        } else {
            return redirect()
                ->route('profiles.plans', $profile->id)
                ->with('message', 'Planos vinculados com sucesso!');
        }
    }
    
    /**
     * detachPlansProfile
     *
     * @param  mixed $idProfile
     * @param  mixed $idPlan
     * @return void
     */
    public function detachPlansProfile($idProfile, $idPlan)
    {
        $profile = $this->profile->find($idProfile);
        $plan = $this->plan->find($idPlan);

        if(!$profile || !$plan) {
            return redirect()->back();
        }
    
        $profile->plans()->detach($plan);
    
        return redirect()
            ->route('profiles.plans', $profile->id)
            ->with('message', 'Plano desvinculado com sucesso!');
    }
        
    /**
     * filterPlansAvailable
     *
     * @param  mixed $request
     * @param  mixed $idProfile
     * @return void
     */
    public function filterPlansAvailable(Request $request, $idProfile)
    {
        if(!$profile = $this->profile->find($idProfile)) {
            return redirect()->back();
        }

        $filter = $request->except('_token');
        $plans = $profile->plansAvailable($request->filter);

        return view('admin.pages.profiles.plans.available', compact('profile', 'filter', 'plans'));
    }
    
    /**
     * filterPlansLinked
     *
     * @param  mixed $request
     * @param  mixed $idProfile
     * @return void
     */
    public function filterPlansLinked(Request $request, $idProfile)
    {
        if(!$profile = $this->profile->find($idProfile)) {
            return redirect()->back();
        }

        $filter = $request->except('_token');  
        $plans = $profile->plansLinked($request->filter);

        return view('admin.pages.profiles.plans.plans', compact('profile', 'filter', 'plans'));
    }
    
    /**
     * filterProfilesLinked
     *
     * @param  mixed $request
     * @param  mixed $idPlan
     * @return void
     */
    public function filterProfilesLinked(Request $request, $idPlan)
    {
        if(!$plan = $this->plan->find($idPlan)) {
            return redirect()->back();
        }

        $filter = $request->except('_token');  
        $profiles = $plan->profilesLinked($request->filter);

        return view('admin.pages.plans.profiles.profiles', compact('profiles', 'filter', 'plan'));
    }
}
