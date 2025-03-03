<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\SaveProductRequest;

class ProductController extends Controller
{
    public function index(Request $request) {
        $query = Product::query();
        
        $product = new Product();
        $searchableFields = $product->getFillable();

        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $searchField = $request->search_field ?? 'all';
            
            if ($searchField == 'all') {
                $query->where(function($q) use ($searchTerm, $searchableFields) {
                    foreach ($searchableFields as $field) {
                        $q->orWhere($field, 'like', "%{$searchTerm}%");
                    }
                });
            } elseif (in_array($searchField, $searchableFields)) {
                $query->where($searchField, 'like', "%{$searchTerm}%");
            }
        }
        
        $products = $query->orderBy('created_at')->paginate(3);
        
        $products->appends($request->only(['search', 'search_field']));
        
        return view('products.index', compact('products'));
    }

    public function create(Product $product) {
        return view('products.create', compact('product'));
    }

    public function store(SaveProductRequest $request) {

        $product = Product::create($request->validated());

        return redirect()->route('products.show', $product)
                         ->with('status', 'Product created');
    }

    public function show(Product $product) {

        return view('products.show', compact('product'));
    }

    public function edit(Product $product) {
        return view('products.edit', compact('product'));
    }

    public function update(SaveProductRequest $request, Product $product) {
        $product->update($request->validated());

        return redirect()->route('products.show', $product)
                         ->with('status', 'Product updated');
    }

    public function destroy(Product $product) {
        $product->delete();

        return redirect()->route('products.index')
                         ->with('status', 'Product Deleted');
    }
}
