<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories', ['categories' => $categories]);
    }

    public function create()
    {
        return view('form.add-category-form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|unique:categories'
        ]);

        $request['category'] = strtolower($request['category']);

        $category = Category::create([
            'category' => $request['category']
        ]);

        if ($category) {
            return redirect('/categories')->with(['success' => 'Success Add New Category']);
        } else {
            return redirect('/categories')->with(['failed' => 'Success Add New Category']);
        }
    }

    public function edit($slug)
    {
        $category = Category::where('slug', $slug)->first();
        return view('form.edit-category-form', ['category' => $category]);
    }

    public function update(Request $request, $slug)
    {
        if ($request['old-category'] == $request['category']) {
            return redirect('/categories')->with(['success' => 'Success Edit Category']);
        };

        $request->validate([
            'category' => 'required|unique:categories'
        ]);

        $category = Category::where('slug', $slug)->first();
        $category->slug = null;
        $category->update([
            'category' => $request['category']
        ]);

        if ($category) {
            return redirect('/categories')->with(['success' => 'Success Edit Category']);
        } else {
            return redirect('/categories')->with(['failed' => 'Failed Edit Category']);
        }
    }

    public function destroy($slug)
    {
        $category = Category::where('slug', $slug)->first();
        // dd($category->books()->exists());
        if ($category->books()->exists()) {
            return redirect('/categories')->with(['failed' => 'Failed to delete category, because the category data is used by another table.']);
        } else {
            $res = $category->delete();
            if ($res) {
                return redirect('/categories')->with(['success' => 'Success Delete Category']);
            } else {
                return redirect('/categories')->with(['failed' => 'Failed Delete Category']);
            }
        }
    }
}
