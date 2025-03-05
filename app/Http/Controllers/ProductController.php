<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\SaveProductRequest;

class ProductController extends Controller
{
    public function index () {
        return view('products.index', [
            'products' => Product::orderBy('created_at')->paginate(3)
        ]);
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
