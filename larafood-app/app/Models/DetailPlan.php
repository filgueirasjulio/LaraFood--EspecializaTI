<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPlan extends Model
{    
    /**
     * table
     *
     * @var string
     */
    protected $table = "details_plan"; 

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = ['name'];
    
    /**
     * plan
     *
     * @return void
     */
    public function plan()
    {
        $this->belongsTo(Plan::class);
    }
    
    /**
     * search
     *
     * @param  mixed $filter
     * @param  mixed $idPlan
     * @return void
     */
    public function search($filter = null, $idPlan)
    {
        $results = $this->where('name', 'LIKE', "%{$filter}%")
                        ->where('plan_id', $idPlan)
                        ->paginate();
        return $results;
    }
}
