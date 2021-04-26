<?php

namespace App\Models;

use App\Companies\Traits\CompanyTrait;
use App\Traits\SearchNameDescriptionTrait;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use CompanyTrait;
    use SearchNameDescriptionTrait;

    protected $fillable = ['name', 'url', 'description'];


    public function products()
    {
        $this->belongsToMany(Product::class);
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
}
