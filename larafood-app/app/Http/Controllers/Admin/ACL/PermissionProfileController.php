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

    public function permissionsAvailable($idProfile)
    {
        if(!$profile = $this->profile->find($idProfile)) {
            return redirect()->back();
        }

        $permissions = $profile->permissionsAvailable();

        return view('admin.pages.profiles.permissions.available', compact('profile', 'permissions'));
    }

    public function attachPermissionsProfile(Request $request, $idProfile)
    {
        if(!$profile = $this->profile->find($idProfile)) {
            return redirect()->back();
        }

        if(!$request->permissions || count($request->permissions) == 0) {
            return redirect()->back()
                             ->with('warning', 'Selecione pelo menos uma permissão!');
        }

        $profile->permissions()->attach($request->permissions);

        if(count($request->permissions) == 1) {
            return redirect()
            ->route('profiles.permissions', $profile->id)
            ->with('message', 'Permissão vinculada com sucesso!');
        } else {
            return redirect()
            ->route('profiles.permissions', $profile->id)
            ->with('message', 'Permissões vinculadas com sucesso!');
        }
    }
}
