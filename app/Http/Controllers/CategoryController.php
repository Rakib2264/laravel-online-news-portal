<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CategoryController extends Controller
{

    public function index()
    {
        $categorys = Category::orderBy('order_by')->get();
        return view('backend.modules.category.index', compact('categorys'));
    }


    public function create()
    {
        return view('backend.modules.category.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'slug' => 'required|min:3|max:255|unique:categories',
            'order_by' => 'required|numeric',
            'status' => 'required',
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->slug);
        $category->order_by = $request->order_by;
        $category->status = $request->status;
        $category->save();
        session()->flash('cls', 'success');
        session()->flash('msg', 'Category Created Successfully');
        return redirect()->route('category.index');
    }


    public function show(Category $category)
    {

        return view('backend.modules.category.show', compact('category'));
    }


    public function edit(Category $category)
    {
        return view('backend.modules.category.edit', compact('category'));
    }


    public function update(Request $request, Category $category){

        
        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->slug),
            'order_by' => $request->order_by,
            'status' => $request->status,
        ]);

        session()->flash('success', 'Category Updated Successfully');
        session()->flash('cls', 'success');
        return redirect()->route('category.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('cls', 'danger');
        session()->flash('success', 'Category Deleted Successfully');
        return redirect()->route('category.index');
    }
}
