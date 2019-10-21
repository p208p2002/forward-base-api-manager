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
Route::post('/login','API\Login');

// 測試用的假APP
Route::any('/udic-app','Test\FakeApp');

// Authorization:API_KEY
Route::group(['middleware' => ['auth.api']], function () {
    Route::get('/test',function(){
        return 'ok';
    });
    //匹配任何方法，塞入指定APP認證key轉送udic service url、header、body資料
    Route::any('/service/{service_url}', 'API\ServiceAccess')->where('service_url', '.*');
});
