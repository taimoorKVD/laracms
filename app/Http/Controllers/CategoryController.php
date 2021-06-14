<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckCategoryRequest;

use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return view('category.index')->with('categories', Category::orderBy('id','desc')->paginate(7));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(CheckCategoryRequest $ccr)
    {
        $category = new Category();
        $category->name = request()->name;
        $category->save();

        return redirect()
            ->route('categories.index')
            ->with('message', 'Category created successfully!');
    }

    public function show($id)
    {
        //
    }

    public function edit(Category $category)
    {
        return view('category.create')->with('category', $category);
    }

    public function update(CheckCategoryRequest $ccr, Category $category)
    {
        $category->name = request()->name;
        $category->save();

        return redirect()
            ->route('categories.index')
            ->with('message', 'Category updated successfully!');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()
            ->back()
            ->with('message', 'Category deleted successfully');
    }
}
