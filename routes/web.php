<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\CategoriesController;


Auth::routes();

Route::group(['middleware' => 'auth'], function(){

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/store/post/', [PostController::class, 'store'])->name('post.store');
    Route::get('/edit/post/{id}', [PostController::class, 'edit'])->name('post.edit');
    Route::get('/show/post/{id}', [PostController::class, 'show'])->name('post.show');
    Route::patch('/update/post/{id}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/destroy/post/{id}', [PostController::class, 'destroy'])->name('post.destroy');

    #comment

    Route::group(["as"=>"comment.", "prefix"=>"comment"], function () {
        Route::post('/store/{id}',[CommentController::class, 'store'])->name('store');
        Route::delete('/destroy/{id}',[CommentController::class, 'destroy'])->name('destroy');
    });

    #profile

    Route::group(["prefix" => "profile", "as" => "profile."], function(){
        Route::get('/show/{id}/', [ProfileController::class, 'show'])->name('show');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/update', [ProfileController::class, 'update'])->name('update');
    });

    #like

    Route::group(["prefix" => "like", "as" => "like."], function () {
        Route::post('/store/{id}',[LikeController::class, 'store'])->name('store');
        Route::delete('/destroy/{id}',[LikeController::class, 'destroy'])->name('destroy');
    });

    #follow
    Route::group(["prefix" => "follow", "as" => "follow."], function () {
        Route::post('/store/{id}',[FollowController::class, 'store'])->name('store');
        Route::delete('/destroy/{id}',[FollowController::class, 'destroy'])->name('destroy');
    });

    #Admin
    Route::group(["prefix" => "admin", "as" => "admin."], function(){
        Route::get('/users', [UsersController::class, 'index'])->name('users.index');
        Route::delete('/users/{id}/deactivate', [UsersController::class, 'deactivate'])->name('users.deactivate');
        Route::patch('/users/{id}/activate', [UsersController::class, 'activate'])->name('users.activate');

        Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');
        Route::delete('/posts/{id}/hide', [PostsController::class, 'hide'])->name('posts.hide');
        Route::patch('/posts/{id}/unhide', [PostsController::class, 'unhide'])->name('posts.unhide');

        Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.index');
        Route::post('/create/categories', [CategoriesController::class, 'create'])->name('categories.create');
        Route::patch('/update/categories/{id}', [CategoriesController::class, 'update'])->name('categories.update');
        Route::delete('categories/{id}/uncategorised', [CategoriesController::class, 'uncategorised'])->name('categories.uncategorised');
    });
});
