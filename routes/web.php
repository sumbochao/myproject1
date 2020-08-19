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


Route::get('admin/login', ['as' => 'admin.login', 'uses' => 'Auth\LoginController@getLogin']);
Route::post('admin/login', ['as' => 'admin.check', 'uses' => 'Auth\LoginController@postLogin']);
Route::group(['middleware' => 'login'],function (){
    Route::group(['prefix' =>'admin'],function (){
        Route::get('/dashboard',['as' => 'admin.dashboard', 'uses' => 'UserController@dashboard']);
    });
    Route::group(['prefix' =>'user'],function (){
        Route::get('/user-list',['as' => 'user.list', 'uses' => 'UserController@getList']);
    });
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
