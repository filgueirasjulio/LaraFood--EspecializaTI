<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUser;

class UserController extends Controller
{
    private $repository;
    
    /**
     * __construct
     *
     * @param  mixed $user
     * @return void
     */
    public function __construct(User $user)
    {
        $this->repository = $user;
    }
        
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $users = $this->repository->latest()->paginate();
        $filter = '';

        return view('admin.pages.users.index', compact('users', 'filter'));
    }
    
    /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        $profile = $this->repository->where('id', $id)->first();
        if (!$profile) {
            return redirect()->back();
        }

        return view('admin.pages.profiles.show', ['profile' => $profile]);
    }
        
    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('admin.pages.users.create');
    }
        
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(StoreUpdateUser $request)
    {
        $data = $request->all();
        $data['company_id'] = auth()->user()->company->id;

        $this->repository->create($request->all());

        return redirect()
            ->route('users.index')
            ->with('message', 'Usuários cadastrado com sucesso!');
    }
        
    /**
     * edit
     *
     * @param  mixed $id
     * @return void
     */
    public function edit($id)
    {
        $profile = $this->repository->find($id);
        
        return view('admin.pages.profiles.edit', compact('profile'));
    }
        
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function update(StoreUpdateUser $request, $id)
    {
       if(!$profile = $this->repository->find($id)) 
           return redirect()->back();
       
       $profile->update($request->all());

       return redirect()
       ->route('profiles.index')
       ->with('message', 'Perfil editado com sucesso!');
    }
        
    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        if(!$profile = $this->repository->find($id)) 
        return redirect()->back();
    
        $profile->delete();

        return redirect()
        ->route('profiles.index')
        ->with('message', 'Perfil deletado com sucesso!'); 
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
        $profiles = $this->repository->search($request->filter);

        return view('admin.pages.profiles.index', [
            'profiles' => $profiles,
            'filter' => $filter,
        ]);
    }
}
