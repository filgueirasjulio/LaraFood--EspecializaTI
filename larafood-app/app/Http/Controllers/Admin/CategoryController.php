<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdateCategory;

class CategoryController extends Controller
{
    private $repository;
    
    /**
     * __construct
     *
     * @param  mixed $category
     * @return void
     */
    public function __construct(Category $category)
    {
        $this->repository = $category;
    }
    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $categories = $this->repository->latest()->paginate();
        $filter = '';

        return view('admin.pages.categories.index', compact('categories', 'filter'));
    }
    
    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('admin.pages.categories.create'); 
    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(StoreUpdateCategory $request)
    {
        $this->repository->create($request->all());

        return redirect()
               ->route('categories.index')
               ->with('message', 'Categoria adicionada com sucesso!');
    }
    
    /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
 
        if (!$category = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.categories.show', compact('category'));
    }
    
    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        if (!$category = $this->repository->find($id)) {
            return redirect()->back();
        }

        $category->delete();

        return redirect()
                ->route('categories.index')
                ->with('message', 'Categoria removida com sucesso!');
    }
    
    /**
     * edit
     *
     * @param  mixed $id
     * @return void
     */
    public function edit($id)
    {
        if (!$category = $this->repository->find($id)) {
            return redirect()->back();
        } 
        
        return view('admin.pages.categories.edit', compact('category'));
    }   

    public function update(StoreUpdateCategory $request, $id)
    {
        if (!$category = $this->repository->find($id)) {
            return redirect()->back();
        } 
        
        $category->update($request->all());

        return redirect()
            ->route('categories.index')
            ->with('message', 'Categoria editada com sucesso!');
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

        $categories = $this->repository->search($request->filter);

        return view('admin.pages.categories.index', [
            'categories' => $categories,
            'filter' => $filter,
        ]);
    }
    
}
