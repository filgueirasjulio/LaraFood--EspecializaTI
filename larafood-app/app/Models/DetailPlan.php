<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPlan extends Model
{
    protected $table = "details_plan";
    protected $fillable = ['name'];

    public function plan()
    {
        $this->belongsTo(Plan::class);
    }

    public function search($filter = null, $idPlan)
    {
        $results = $this->where('name', 'LIKE', "%{$filter}%")
                        ->where('plan_id', $idPlan)
                        ->paginate();
        return $results;
    }
}
