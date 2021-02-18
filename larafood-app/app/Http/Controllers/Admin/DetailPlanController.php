<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plan;
use App\Models\DetailPlan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateDetailPlan;

class DetailPlanController extends Controller
{
    private $repository, $plan;
       
    /**
     * __construct
     *
     * @param  mixed $detailPlan
     * @param  mixed $plan
     * @return void
     */
    public function __construct(DetailPlan $detailPlan, Plan $plan)
    {
        $this->repository = $detailPlan;
        $this->plan = $plan;
    }
       
    /**
     * index
     *
     * @param  mixed $urlPlan
     * @return void
     */
    public function index($urlPlan)
    {
        if(!$plan = $this->plan->where('url', $urlPlan)->first()) {
            return redirect()->back();
        }

        $details = $plan->details()->latest()->paginate();
        $filter = '';

        return view('admin.pages.plans.details.index', compact('plan', 'details', 'filter'));
    }
     
    /**
     * create
     *
     * @param  mixed $urlPlan
     * @return void
     */
    public function create($urlPlan)
    {
        if(!$plan = $this->plan->where('url', $urlPlan)->first()) {
            return redirect()->back();
        }

        return view('admin.pages.plans.details.create', compact('plan'));
    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @param  mixed $urlPlan
     * @return void
     */
    public function store(StoreUpdateDetailPlan $request, $urlPlan)
    {
        if(!$plan = $this->plan->where('url', $urlPlan)->first()) {
            return redirect()->back();
        }

        $plan->details()->create($request->all());

        return redirect()
                ->route('details.plan.index', $plan->url)
                ->with('message', 'Detalhe cadastrado com sucesso!');;
    }
    
    /**
     * edit
     *
     * @param  mixed $urlPlan
     * @param  mixed $idDetail
     * @return void
     */
    public function edit($urlPlan, $idDetail)
    {
        $plan = $this->plan->where('url', $urlPlan)->first();
        $detail = $this->repository->find($idDetail);
        if(!$plan || !$idDetail) {
            return redirect()->back();
        }

        return view('admin.pages.plans.details.edit', compact('plan', 'detail'));
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $urlPlan
     * @param  mixed $idDetail
     * @return void
     */
    public function update(StoreUpdateDetailPlan $request, $urlPlan, $idDetail)
    {
        $plan = $this->plan->where('url', $urlPlan)->first();
        $detail = $this->repository->find($idDetail);
        if(!$plan || !$idDetail) {
            return redirect()->back();
        }

        $detail->update($request->all());

        return redirect()
                ->route('details.plan.index', $plan->url)
                ->with('message', 'Detalhe editado com sucesso!');;
    }
    
    /**
     * destroy
     *
     * @param  mixed $urlPlan
     * @param  mixed $idDetail
     * @return void
     */
    public function destroy($urlPlan, $idDetail)
    {
        $plan = $this->plan->where('url', $urlPlan)->first();
        $detail = $this->repository->find($idDetail);
        if(!$plan || !$idDetail) {
            return redirect()->back();
        }

        $detail->delete();

        return redirect()
                ->route('details.plan.index', $plan->url)
                ->with('message', 'Detalhe removido com sucesso!');;
    }
    
    /**
     * search
     *
     * @param  mixed $request
     * @param  mixed $urlPlan
     * @return void
     */
    public function search(Request $request, $urlPlan)
    {
        $filter = $request->except('_token');

        $plan = $this->plan->where('url', $urlPlan)->first();
        if (!$plan) {
            return redirect()->back();
        }
        $planId = ($plan->id);
   
        $details = $this->repository->search($request->filter, $planId);

        return view('admin.pages.plans.details.index', [
            'plan' => $plan,
            'details' => $details,
            'filter' => $filter,
        ]);
    }
}
