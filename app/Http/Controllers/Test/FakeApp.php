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
        // return $request->method()." SUCCESS";
        $AppKey = 'KEY_UDIC_APP';
        $keyFromReq = $request->header('AppKey');
        dd('認證狀態',strcmp($AppKey,$keyFromReq)==0,$request->header(),$request->all());       
    }
}
