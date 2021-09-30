<?php

use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\registerController;
use App\Http\Controllers\DashboardController;


use App\Http\Controllers\PostController\CreatePost;
use App\Http\Controllers\PostController\PostController;
use App\Http\Controllers\PostController\PostDashboard;
use App\Http\Controllers\PostController\ShowPost;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');



Route::get('post/{id}/show',[ShowPost::class, 'index'])->name('post.show');

Route::get('posts/dashboard/sale',[PostDashboard::class, 'saleIndex'])->name('posts.sale');
Route::get('posts/dashboard/rent',[PostDashboard::class, 'rentIndex'])->name('posts.rent');

Route::get('posts/search',[PostDashboard::class, 'filter'])->name('posts.search');
Route::get('home/posts/search',[PostDashboard::class, 'homeFilter'])->name('home.search');

Route::post('logout',[LogoutController::class, 'store'])->name('logout');

Route::get('register',[RegisterController::class, 'index'])->name('register');
Route::post('register',[RegisterController::class, 'store']);

Route::get('login',[LoginController::class, 'index'])->name('login');
Route::post('login',[LoginController::class, 'store']);

Route::get('post/index/edit/{post}',[PostController::class, 'editIndex'])->name('post.index.edit');
Route::post('post/delete/{id}',[PostController::class, 'delete'])->name('post.delete');
Route::post('post/edit/{post}',[PostController::class, 'edit'])->name('post.edit');

Route::post('post/cancel/{id}',[PostController::class, 'cancel'])->name('edit.cancel');

Route::group(['middleware'=>['AuthCheck']], function (){
    Route::get('post/create',[CreatePost::class, 'index'])->name('post.create');
    Route::post('post/create',[CreatePost::class, 'store']);
});

Route::group(['prefix'=>'admin', 'middleware'=>['isAdmin','auth']], function(){
    Route::get('dashboard',[AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('dashboard/edit/{post}',[AdminController::class, 'delete'])->name('admin.edit');
    Route::post('dashboard/delete/{post}',[AdminController::class, 'delete'])->name('admin.delete');
});
