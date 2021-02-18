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
      
        $permissions = $profile->permissions()->latest()->paginate();
        $filter = '';

        return view('admin.pages.profiles.permissions.permissions', compact('profile', 'permissions', 'filter'));
    }

    public function profiles($idPermission)
    {
        $permission = $this->permission->find($idPermission);
        if(!$permission) {
            return redirect()->back();
        }

        $profiles = $permission->profiles()->latest()->paginate();
        $filter = '';
        
        return view('admin.pages.permissions.profiles.profiles', compact('permission', 'profiles', 'filter'));
    }

    public function permissionsAvailable($idProfile)
    {
        if(!$profile = $this->profile->find($idProfile)) {
            return redirect()->back();
        }

        $permissions = $profile->permissionsAvailable();
        $filter = '';

        return view('admin.pages.profiles.permissions.available', compact('profile', 'permissions', 'filter'));
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

    public function detachPermissionsProfile($idProfile, $idPermission)
    {
        $profile = $this->profile->find($idProfile);
        $permission = $this->permission->find($idPermission);

        if(!$profile || !$permission) {
            return redirect()->back();
        }

        $profile->permissions()->detach($permission);

        return redirect()
            ->route('profiles.permissions', $profile->id)
            ->with('message', 'Permissão desvinculada com sucesso!');
    }

    public function filterPermissionsAvailable(Request $request, $idProfile)
    {
        if(!$profile = $this->profile->find($idProfile)) {
            return redirect()->back();
        }

        $filter = $request->except('_token');
        $permissions = $profile->permissionsAvailable($request->filter);

        return view('admin.pages.profiles.permissions.available', compact('profile', 'filter', 'permissions'));
    }

    public function filterPermissionsLinked(Request $request, $idProfile)
    {
        if(!$profile = $this->profile->find($idProfile)) {
            return redirect()->back();
        }

        $filter = $request->except('_token');  
        $permissions = $profile->permissionsLinked($request->filter);

        return view('admin.pages.profiles.permissions.permissions', compact('profile', 'filter', 'permissions'));
    }

    public function filterProfilesLinked(Request $request, $idPermission)
    {
        if(!$permission = $this->permission->find($idPermission)) {
            return redirect()->back();
        }

        $filter = $request->except('_token');  
        $profiles = $permission->profilesLinked($request->filter);

        return view('admin.pages.permissions.profiles.profiles', compact('profiles', 'filter', 'permission'));
    }
}
