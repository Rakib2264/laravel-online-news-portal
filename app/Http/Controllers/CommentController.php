<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'post_id'=>'required',
            'comment'=>'required|min:5|max:1000',
        ]);

        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->post_id = $request->post_id;
        $comment->status = 1 ;
        $comment->user_id = Auth::user()->id;
        $comment->save();
        return redirect()->back()->with('success','আপনার কমেন্ট পাঠানো হয়েছে');

    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
