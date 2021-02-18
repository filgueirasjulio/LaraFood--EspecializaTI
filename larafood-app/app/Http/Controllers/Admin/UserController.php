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
        $users = $this->repository->latest()->companyUser()->paginate();
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
        $user = $this->repository->where('id', $id)->first();
        if (!$user) {
            return redirect()->back();
        }

        return view('admin.pages.users.show', ['user' => $user]);
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
        $data['password'] = bcrypt($data['password']);

        $this->repository->create($data);

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
        $user = $this->repository->find($id);
        
        return view('admin.pages.users.edit', compact('user'));
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
       if(!$user = $this->repository->find($id)) {
           return redirect()->back();
       }

       $user->update($request->all());

       return redirect()
       ->route('users.index')
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
        if(!$user = $this->repository->find($id)) {
            return redirect()->back();
        }
    
        $user->delete();

        return redirect()
        ->route('users.index')
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
        $users = $this->repository->search($request->filter);

        return view('admin.pages.users.index', [
            'users' => $users,
            'filter' => $filter,
        ]);
    }
}
