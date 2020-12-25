<?php

namespace App\Models;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['name', 'description'];

    public function search($filter = null)
    {
        $results = $this->where('name', 'LIKE', "%{$filter}%")
                        ->orWhere('description', 'LIKE', "%{$filter}%")
                        ->paginate();
        return $results;
    }

    /**
     * Get Permissions
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
