<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::orderBy('order_by')->get();
        return view('backend.modules.tag.index',compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.modules.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'order_by' => 'required|numeric',
            'status' => 'required',
        ]);

        $tags = new Tag();
        $tags->name = $request->name;
        $tags->slug = Str::slug($request->name);
        $tags->order_by = $request->order_by;
        $tags->status = $request->status;
        $tags->save();
        session()->flash('cls','success');
        session()->flash('msg','Tag Created Successfully');
        return redirect()->route('tag.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        return view('backend.modules.tag.show',compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view('backend.modules.tag.edit',compact('tag'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $tag->update([
            'name' => $request->name,
            'slug' => Str::slug($request->slug),
            'order_by' => $request->order_by,
            'status' => $request->status,
        ]);

        session()->flash('cls', 'success');
        session()->flash('success', 'Tag Updated Successfully');
        return redirect()->route('tag.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        session()->flash('cls', 'danger');
        session()->flash('success', 'Tag Deleted Successfully');
        return redirect()->route('tag.index');
    }
}
