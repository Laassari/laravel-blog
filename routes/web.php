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
    return view('home', [
    	'var' => 'this is a variable from php',
    ]);
});

Auth::routes();

Route::resource('posts', 'PostController');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/account', 'UserController@show');
Route::put('/account', 'UserController@update')->name('account.update');