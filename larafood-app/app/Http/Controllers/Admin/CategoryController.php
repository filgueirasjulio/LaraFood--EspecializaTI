<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
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
}
