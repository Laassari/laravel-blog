<?php

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
    return redirect('/posts');
});

Auth::routes();

Route::get('/account', 'UserController@show');
Route::put('/account', 'UserController@update')->name('account.update');
Route::put('/account/change-password', 'UserController@changePassword')->name('account.changePassword');

Route::get('/home', 'HomeController@index')->name('home');

# posts reources
Route::resource('posts', 'PostController');
Route::get('/posts/by-tag/{tag}', 'PostController@getPostsByTag');
Route::post('/posts/{post}/toggle-like', 'PostController@togglePostLike');

// comments resources
Route::get('/posts/{post}/comments', 'CommentController@index');
Route::post('/posts/{post}/comments', 'CommentController@store');
Route::post('/comments/{comment}/toggle-like', 'CommentController@toggleCommentLike');
