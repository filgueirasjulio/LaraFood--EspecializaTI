<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Models\Profile;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionProfileController extends Controller
{
    private $permission, $profile;

    public function __construct(Permission $permission, Profile $profile)
    {
        $this->permission = $permission;
        $this->profile = $profile;
    }

    public function permissions($idProfile)
    {
        $profile = $this->profile->find($idProfile);
        if(!$profile) {
            return redirect()->back();
        }
      
        $permissions = $profile->permissions()->paginate();

        return view('admin.pages.profiles.permissions.permissions', compact('profile', 'permissions'));
    }
}
