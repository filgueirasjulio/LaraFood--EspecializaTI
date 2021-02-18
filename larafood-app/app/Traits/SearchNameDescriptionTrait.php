<?php
namespace App\Traits;

trait SearchNameDescriptionTrait
{
    /**
     * @param null $filter
     * 
     * @return [type]
     */
    public function SearchNameDescription($filter = null)
    {
        $results = $this->where('name', 'LIKE', "%{$filter}%")
                        ->orWhere('description', 'LIKE', "%{$filter}%")
                        ->paginate();
        return $results;
    }
}