<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FakeApp extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $AppKey = '1yIyEY1EWrw8UZWLy2mffvToDqX1cNWs';
        $keyFromReq = $request->header('AppKey');
        $auth_state =  ($AppKey == $keyFromReq?'認證通過':'認證失敗');
        return response()->json([
            'auth_state'=>$auth_state,
            'http_method'=>$request->method(),
            'header' => $request->header(),
            'request_all'=>$request->all(),
            'full_url'=>$request->fullUrl()
        ],200,[],JSON_UNESCAPED_UNICODE);
    }
}
