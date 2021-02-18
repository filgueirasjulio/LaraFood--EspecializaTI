<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePermission;

class PermissionController extends Controller
{

    private $repository;
    
    /**
     * __construct
     *
     * @param  mixed $permission
     * @return void
     */
    public function __construct(Permission $permission)
    {
        $this->repository = $permission;
    }
    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $permissions = $this->repository->latest()->paginate();
        $filter = '';

        return view('admin.pages.permissions.index', compact('permissions', 'filter'));
    }
    
    /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        $permission = $this->repository->where('id', $id)->first();
        if (!$permission)
            return redirect()->back();

        return view('admin.pages.permissions.show', compact('permission'));
    }
    
    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('admin.pages.permissions.create');
    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(StoreUpdatePermission $request)
    {
        $this->repository->create($request->all());

        return redirect()
            ->route('permissions.index')
            ->with('message', 'Permissão cadastrada com sucesso!');
    }
    
    /**
     * edit
     *
     * @param  mixed $id
     * @return void
     */
    public function edit($id)
    {
        $permission = $this->repository->find($id);

        return view('admin.pages.permissions.edit', compact('permission'));
    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function update(StoreUpdatePermission $request, $id)
    {
        if (!$permission = $this->repository->find($id))
            return redirect()->back();

        $permission->update($request->all());

        return redirect()
            ->route('permissions.index')
            ->with('message', 'Permissão editada com sucesso!');
    }
 
    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        if (!$permission = $this->repository->find($id))
            return redirect()->back();

        $permission->delete();

        return redirect()
            ->route('permissions.index')
            ->with('message', 'Permissão deletada com sucesso!');
    }
    
    /**
     * search
     *
     * @param  mixed $request
     * @return void
     */
    public function search(Request $request)
    {
        $filter = $request->except('_token');
        $permissions = $this->repository->search($request->filter);

        return view('admin.pages.permissions.index', [
            'permissions' => $permissions,
            'filter' => $filter,
        ]);
    }
}
