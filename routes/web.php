<?php

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Frontend

Route::get('/',[FrontendController::class,'index'])->name('front.index');
Route::get('/all-post',[FrontendController::class,'all_post'])->name('front.all_post');
Route::get('/search',[FrontendController::class,'search'])->name('front.search');

Route::get('/category/{slug}',[FrontendController::class,'category'])->name('front.category');
Route::get('/category/{cat_slug}/{sub_cat_slug}',[FrontendController::class,'sub_category'])->name('front.sub_category');
Route::get('/tag/{slug}',[FrontendController::class,'tag'])->name('front.tags');


Route::get('/single-post/{slug}',[FrontendController::class,'single'])->name('front.single');


// Backend

Route::prefix('dashboard')->group(function () {
    Route::get('/',[BackendController::class,'index'])->name('back.index');
    Route::resource('category',CategoryController::class);
    Route::get('/get-subcategory/{id}',[SubCategoryController::class,'getSubCategoryByCategoryId']);
    Route::resource('sub_category',SubCategoryController::class);
    Route::resource('tag',TagController::class);
    Route::resource('post',PostController::class);

    Route::resource('comment' ,CommentController::class);

 });










require __DIR__.'/auth.php';
