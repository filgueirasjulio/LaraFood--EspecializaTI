<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreUpdateProduct;

class ProductController extends Controller
{
    private $repository;
    
    /**
     * __construct
     *
     * @param  mixed $Product
     * @return void
     */
    public function __construct(Product $product)
    {
        $this->repository = $product;
    }
    
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $products = $this->repository->latest()->paginate();
        $filter = '';

        return view('admin.pages.products.index', compact('products', 'filter'));
    }
    
    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('admin.pages.products.create'); 
    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(StoreUpdateproduct $request)
    {
        $data = $request->all();

        $company = auth()->user()->company;

        if ($request->hasFile('image') && $request->image->isValid()) {
            $data["image"] =  $request->image->store("companies/{$company->uuid}/products");
        }

        $this->repository->create($data);

        return redirect()
               ->route('products.index')
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
 
        if (!$product = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.products.show', compact('product'));
    }
    
    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        if (!$product = $this->repository->find($id)) {
            return redirect()->back();
        }

        if (Storage::exists($product->image)) {
            Storage::delete($product->image);
        }

        $product->delete();

        return redirect()
                ->route('products.index')
                ->with('message', 'Produto removido com sucesso!');
    }
    
    /**
     * edit
     *
     * @param  mixed $id
     * @return void
     */
    public function edit($id)
    {
        if (!$product = $this->repository->find($id)) {
            return redirect()->back();
        } 
        
        return view('admin.pages.products.edit', compact('product'));
    }   

    public function update(StoreUpdateProduct $request, $id)
    {
        if (!$product = $this->repository->find($id)) {
            return redirect()->back();
        } 
        
        $data = $request->all();

        $company = auth()->user()->company;

        if ($request->hasFile('image') && $request->image->isValid()) {

            if (Storage::exists($product->image)) {
                Storage::delete($product->image);
            }

            $data["image"] =  $request->image->store("companies/{$company->uuid}/products");
        }

        $product->update($data);

        return redirect()
            ->route('products.index')
            ->with('message', 'Produto editado com sucesso!');
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

        $products = $this->repository->search($request->filter);

        return view('admin.pages.products.index', [
            'products' => $products,
            'filter' => $filter,
        ]);
    }
    
}
