<?php

namespace App\Providers;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        $categories = Category::with('sub_categories')->where('status',1)->orderBy('order_by','asc')->get();
        $tags = Tag::where('status',1)->orderBy('order_by','asc')->get();
        $posts = Post::where('is_apporved',1)->where('status',1)->latest()->take(5)->get();

        View::share([
            'categories'=>$categories,
            'tags'=>$tags,
            'recent_post'=>$posts,
    ]);
    }
}
