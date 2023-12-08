<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PostCountController;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostCount;
use App\Models\SubCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    public function index(){

        // querys common words
        $query_common = Post::with('category','sub_category','tag','user')->where('is_apporved',1)->where('status',1);

        $posts =  $query_common->latest()->take(5)->get();
        $slider_post =  $query_common->inRandomOrder()->take(6)->get();

         return view('frontend.modules.index',compact('posts','slider_post'));
    }


    public function all_post(){

         // querys common words
         $title = 'All Post';
         $sub_title = 'View All Post List';
         $posts =  Post::with('category','sub_category','tag','user')->where('is_apporved',1)->where('status',1)->latest()->paginate(5);

         return view('frontend.modules.all_post',compact('posts','title','sub_title'));

    }

    public function search(Request $request){
        $posts =  Post::with('category','sub_category','tag','user')
        ->where('is_apporved',1)
        ->where('title','like','%'.$request->input('search').'%')
        ->where('status',1)->latest()
        ->paginate(5);
        // $query = 'SELECT * FROM posts title like %data$';

        $title = 'View Search Result';
        $sub_title = $request->input('search');
        return view('frontend.modules.all_post',compact('posts','title','sub_title'));


    }

    public function category($slug){

       $category = Category::where('slug',$slug)->first();
       if($category){
        $posts =  Post::with('category','sub_category','tag','user')
        ->where('is_apporved',1)
        ->where('category_id',$category->id)
        ->where('status',1)->latest()
        ->paginate(5);
       }

       $title = $category->name;
       $sub_title = 'Post By Category';
       return view('frontend.modules.all_post',compact('posts','title','sub_title'));

    }
    public function sub_category($slug , $sub_slug){

        $sub_category = SubCategory::where('slug',$sub_slug)->first();
        if($sub_category){
         $posts =  Post::with('category','sub_category','tag','user')
         ->where('is_apporved',1)
         ->where('sub_category_id',$sub_category->id)
         ->where('status',1)->latest()
         ->paginate(5);
        }

        $title = $sub_category->name;
        $sub_title = 'Post By Sub Category';
        return view('frontend.modules.all_post',compact('posts','title','sub_title'));

     }

     public function tag(string $slug){

         $tag = Tag::where('slug',$slug)->first();
         $post_ids = DB::table('post_tag')->select('post_id')->where('tag_id',$tag->id)->distinct('post_id')->pluck('post_id');
          if($tag){
          $posts =  Post::with('category','sub_category','tag','user')
         ->where('is_apporved',1)
         ->whereIn('id',$post_ids)
          ->latest()
         ->paginate(10);
        }
        $title = $tag->name;
        $sub_title = 'Post Tag';
        return view('frontend.modules.all_post',compact('posts','title','sub_title'));

     }


     public function single(string $slug){
       $post = Post::with('category','sub_category','tag','user','comment','comment.user','comment.replay')
         ->where('is_apporved',1)
         ->where('status',1)
         ->where('slug',$slug)
         ->firstOrFail();



        //  find , findOrFail
        //  if(!$post){
        //     abort(404);
        //  }
        $title = $post->title;
        $sub_title = 'Single Post';
         return view('frontend.modules.single',compact('post','title','sub_title'));
    }


// contuct us  section
// final bole dile method take overide kora jaynah
final public function contact_us(){

    return view('frontend.modules.contact_us');
}


final public function postReadCount($post_id){

    
     (new PostCountController($post_id))->postReadCount();

}


}
