<?php

namespace App\Models;

use App\Companies\Traits\CompanyTrait;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use CompanyTrait;

    protected $fillable = ['title', 'flag', 'price', 'description', 'image'];

    public function categories()
    {
        $this->belongsToMany(Category::class);
    }

    /**
     * search
     *
     * @param  mixed $filter
     * @return void
     */
    public function search($filter = null)
    {
        $results = $this->where('title', 'LIKE', "%{$filter}%")
        ->orWhere('description', 'LIKE', "%{$filter}%")
        ->paginate();

        return $results;
    }
}
