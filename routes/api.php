<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// https://stackoverflow.com/questions/53716751/location-of-authapi-middleware
Route::post('/login',function(){
    return "login";
});

// Authorization:API_KEY
Route::group(['middleware' => ['auth.api']], function () {
    Route::get('/test',function(){
        return 'ok';
    });
});
