<?php

namespace App\Http\Controllers\Site;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $plans = Plan::with('details')->orderBy('price', 'ASC')->get();
        
        return view('site.pages.home.index', compact('plans'));
    }
    
    /**
     * plan
     *
     * @param  mixed $url
     * @return void
     */
    public function plan($url)
    {
       if(!$plan = Plan::where('url', $url)->first()) {
           return redirect()->back();
       }

       session()->put('plan', $plan);

       return redirect()->route('register');
    }
}
