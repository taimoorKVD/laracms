<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Route::group([ 'prefix' => 'web', 'as' => 'web.'], function(){
    
    Route::get('/', [
        'as' => 'index', 
        'uses' => 'web\blog\PostController@index'
    ]);

    Route::get('/blog/categories/{category}', [
        'as' => 'category', 
        'uses' => 'web\blog\PostController@category'
    ]);
    
    Route::get('/blog/tags/{tag}', [
        'as' => 'tag', 
        'uses' => 'web\blog\PostController@tag'
    ]);

    Route::resource('/blog/posts', 'web\blog\PostController');
});


Auth::routes();

Route::middleware('auth')->group(function(){
    Route::get('/admin/home', 'HomeController@index')->name('home');
    Route::resource('/admin/posts', 'PostController');
    Route::get('/admin/trashed-posts', 'PostController@trashed')->name('trashed-posts.index');
    Route::put('/admin/restore-post/{post}', 'PostController@restore')->name('restore-post');
    Route::resource('/admin/categories', 'CategoryController');
    Route::resource('/admin/tags', 'TagController');
});

Route::middleware(['auth','VerifyIsAdmin'])->group(function(){
    Route::get('/admin/user/profile', 'UserController@edit')->name('user.profile');
    Route::resource('/admin/users', 'UserController');
    Route::post('/admin/users/{user}/make-admin', 'UserController@makeAdmin')->name('users.make-admin');
});
