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
        
        echo $AppKey == $keyFromReq?'認證通過':'認證失敗';
        echo '<br/>';
        echo 'HTTP Method:'.$request->method();
        echo '<br/><br/>';
        echo '接收到的Header資訊與Request:<br/>';
        return response()->json(['header' => $request->header(),'request_all'=>$request->getContent()]);
    }
}
