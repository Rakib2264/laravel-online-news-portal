<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sub_categorys = SubCategory::with('category')->orderBy('order_by')->get();
        return view('backend.modules.sub_category.index',compact('sub_categorys'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $cats = Category::pluck('name','id');
        return view('backend.modules.sub_category.create',compact('cats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' =>'required|min:3|max:255',
            'slug' =>'required|min:3|max:255|unique:sub_categories',
            'order_by' =>'required|numeric',
            'status' =>'required',
            'category_id' =>'required',
        ]);
        $subcategory_date = $request->all();
        $subcategory_date['slug'] = Str::slug($request->input('slug'));
        SubCategory::create($subcategory_date);
        session()->flash('cls','success');
        session()->flash('msg','Sub Category Created Successfully');
        return redirect()->route('sub_category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subCategory)
    {
        $subCategory::with('category')->orderBy('order_by')->first();
        return view('backend.modules.sub_category.show',compact('subCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subCategory)
    {
        $cats = Category::pluck('name','id');
        return view('backend.modules.sub_category.edit',compact('subCategory','cats'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        $subCategory->update([
            'name' => $request->name,
            'slug' => Str::slug($request->slug),
            'order_by' => $request->order_by,
            'status' => $request->status,
            'category_id' => $request->category_id,
        ]);

        session()->flash('cls', 'success');
        session()->flash('success', 'Sub Category Updated Successfully');
        return redirect()->route('sub_category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory)
    {
        $subCategory->delete();
        session()->flash('cls', 'danger');
        session()->flash('success', 'Sub Category Deleted Successfully');
        return redirect()->route('sub_category.index');
    }

    public function getSubCategoryByCategoryId($id){
      $sub_category = SubCategory::select('id','name')->where('status', 1)->where('category_id',$id)->get();
      return response()->json($sub_category);
    }
}
