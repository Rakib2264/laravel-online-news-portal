<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use App\Models\SubCategory;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $querycommon = Post::with('category','sub_category','user','tag');
        if(Auth::user()->role===User::USER){
            $posts =  $querycommon->where('user_id',Auth::id())->latest()->paginate(5);

        }

        $posts =  $querycommon->latest()->paginate(5);


       return view('backend.modules.post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cats = Category::where('status', 1)->pluck('name', 'id');
        $tags = Tag::where('status', 1)->select('name', 'id')->get();

        return view('backend.modules.post.create', compact('cats', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCreateRequest $request)
    {
        $post_data = $request->except(['tag_ids', 'photo']);
        $post_date['slug'] = Str::slug($request->input('slug'));
        $post_data['user_id'] = Auth::user()->id;


        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $name = Str::slug($request->input('slug'));
            $height = 420;
            $width = 1000;
            $thumb_height = 150;
            $thumb_width = 150;
            $path = 'img/post/original/';
            $thumb_path = 'img/post/thumbmail/';
            $post_data['photo'] = PhotoUploadController::imageUpload($name, $height, $width, $path, $file);
            PhotoUploadController::imageUpload($name, $thumb_height, $thumb_width, $thumb_path, $file);
        }

        $post_data['is_apporved'] = 1;
        $post = Post::create($post_data);

        //many to many relaton pivot table
        $post->tag()->attach($request->input('tag_ids'));

        return redirect()->route('post.index')->with('success',"Post Created Successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        
        if(Auth::user()->role == User::USER && $post->user_id !== Auth::id()){
             abort(403,'Unautorized');
        }


        $post->load(['category','sub_category','user','tag']);



        return view('backend.modules.post.show', compact('post'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $cats = Category::where('status', 1)->pluck('name', 'id');
        $tags = Tag::where('status', 1)->select('name', 'id')->get();
         $selected_tags = DB::table('post_tag')->where('post_id',$post->id)->pluck('tag_id')->toArray();
        return view('backend.modules.post.edit',compact('post','cats','tags','selected_tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        $post_data = $request->except(['tag_ids', 'photo', 'slug']);
        $post_date['slug'] = Str::slug($request->input('slug'));
        $post_data['user_id'] = Auth::user()->id;
        $post_date['is_apporved'] = 1;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $name = Str::slug($request->input('slug'));
            $height = 400;
            $width = 1000;
            $thumb_height = 150;
            $thumb_width = 150;
            $path = 'img/post/original/';
            $thumb_path = 'img/post/thumbmail/';

            // old photo delete
            PhotoUploadController::imageUnlink($path , $post->photo);
            PhotoUploadController::imageUnlink($thumb_path , $post->photo);


            $post_data['photo'] = PhotoUploadController::imageUpload($name, $height, $width, $path, $file);
            PhotoUploadController::imageUpload($name, $thumb_height, $thumb_width, $thumb_path, $file);
        }


        $post->update($post_data);
        //many to many relaton pivot table
        $post->tag()->sync($request->input('tag_ids'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Check if the post has a photo
        if ($post->photo) {
            $path = 'img/post/original/';
            $thumb_path = 'img/post/thumbmail/';

            // Old photo delete
            PhotoUploadController::imageUnlink($path, $post->photo);
            PhotoUploadController::imageUnlink($thumb_path, $post->photo);
        }

        // Delete the post
        $post->delete();

        return back()->with('success', "Post Deleted");
    }

}
