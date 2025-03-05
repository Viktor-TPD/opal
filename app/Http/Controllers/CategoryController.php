<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Category::query();

        $category = new Category();
        $searchableFields = $category->getFillable();

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

        //WATCH OUT FOR HARD-CODED VALUE HERE @todo
        $categories = $query->orderBy('created_at')->paginate(3);

        $categories->appends($request->only(['search', 'search_field']));

        return view ('categories.index', compact('category'));
    }

    public function create(Category $category)
    {
        return view ('categories.create', compact('category'));
    }

    public function store(SaveCategoryRequest $request)
    {
        $category = Category::create($request->validated());

        return redirect()->route('categories.show', $category)
                         ->with('status', 'Category created');
    }

    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('product'));
    }

    public function update(SaveCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return redirect()->route('categories.show',$category)
                         ->with('status', 'Category updated');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')
                         ->with('status', 'Category Deleted');
    }
}
