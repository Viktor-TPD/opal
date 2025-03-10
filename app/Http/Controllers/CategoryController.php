<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
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

        $categories = $query->orderBy('created_at')->paginate(10);

        $categories->appends($request->only(['search', 'search_field']));

        return view ('categories.index', compact('categories'));
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
        return view('categories.edit', compact('category'));
    }

    public function update(SaveCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return redirect()->route('categories.show', $category)
                         ->with('status', 'Category updated');
    }

    public function destroy(Request $request, Category $category)
    {
    if ($category->products()->count() > 0 && !$request->has('action')) {
        $otherCategories = Category::where('id', '!=', $category->id)->get();
        return view('categories.confirm-delete', compact('category', 'otherCategories'));
    }
    
    if ($request->has('action')) {
        if ($request->action === 'cancel') {
            return redirect()->route('categories.show', $category)
                ->with('status', 'Deletion cancelled');
        }
        
        switch ($request->action) {
            case 'reassign':
                if ($request->has('new_category_id')) {
                    $newCategory = Category::findOrFail($request->new_category_id);
                    $category->products()->update(['category_id' => $newCategory->id]);
                } else {
                    return redirect()->route('categories.show', $category)
                        ->with('status', 'No category selected for reassignment');
                }
                break;
                
            case 'delete':
                $category->products()->delete();
                break;
                
            case 'orphan':
                $category->products()->update(['category_id' => null]);
                break;
                
            default:
                return redirect()->route('categories.show', $category)
                    ->with('status', 'Invalid action selected');
        }
    }
    
    $category->delete();

    return redirect()->route('categories.index')
        ->with('status', 'Category deleted successfully');
    }
}