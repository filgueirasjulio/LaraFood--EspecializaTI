<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
