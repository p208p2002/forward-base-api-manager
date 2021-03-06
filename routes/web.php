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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::group(['prefix'=>'admin','middleware'=>['auth.admin']],function(){
    Route::get('/', function () {
        return view('admin.index');
    });
    Route::resource('/user-manage', 'UserController');
    Route::resource('/app-key-manage', 'AppKeyManageController');
    Route::resource('/user-auth-limit', 'UserAuthLimit');
    Route::post('/user-auth-limit/add-auth','UserAuthLimit@addAuth');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
