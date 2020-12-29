<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Models\Plan;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlanProfileController extends Controller
{
    
    private $plan, $profile;

    public function __construct(Plan $plan, Profile $profile)
    {
        $this->plan = $plan;
        $this->profile = $profile;
    }

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

    public function plansAvailable($idProfile)
    {
        if(!$profile = $this->profile->find($idProfile)) {
            return redirect()->back();
        }

        $plans = $profile->plansAvailable();
        $filter = '';

        return view('admin.pages.profiles.plans.available', compact('profile', 'plans', 'filter'));
    }

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
    
    public function filterPlansAvailable(Request $request, $idProfile)
    {
        if(!$profile = $this->profile->find($idProfile)) {
            return redirect()->back();
        }

        $filter = $request->except('_token');
        $plans = $profile->plansAvailable($request->filter);

        return view('admin.pages.profiles.plans.available', compact('profile', 'filter', 'plans'));
    }

    public function filterPlansLinked(Request $request, $idProfile)
    {
        if(!$profile = $this->profile->find($idProfile)) {
            return redirect()->back();
        }

        $filter = $request->except('_token');  
        $plans = $profile->plansLinked($request->filter);

        return view('admin.pages.profiles.plans.plans', compact('profile', 'filter', 'plans'));
    }

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
