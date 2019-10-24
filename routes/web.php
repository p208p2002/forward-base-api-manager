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
    // Route::get('/app-key-manage', function () {
    //     return view('admin.app_key_manage');
    // });
    Route::resource('/app-key-manage', 'AppKeyManageController');
    Route::get('/test',function(){
        // dd(App\AppKeyManage::all());
        // return 'ok';
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
