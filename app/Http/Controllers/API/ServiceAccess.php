<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ixudra\Curl\Facades\Curl;

class ServiceAccess extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $service_url)
    {
        $reqMethod = $request->method();
        $header = $request->header();
        $inputData = $request->input();        
        $targetApp = $request->header('App-Name');
        if ($targetApp == null) {
            return response()->json([
                'ServerMsg' => 'App-Name can not be null in Header'
            ], 400);
        }

        //send req
        $response = null;
        $newHeaders = array();
        foreach ($header as $key => $value) {
            $headerNotJoin = array("content-length");
            if (!in_array($key, $headerNotJoin)) {
                array_push($newHeaders, $key . ':' . strval($value[0]));
            }
        }

        // get app key
        $appKey = null;
        if ($targetApp == 'UDIC-APP') {
            $appKey = "KEY_UDIC_APP";
        }
        array_push($newHeaders, 'AppKey' . ':' . strval($appKey));

        $curl =  Curl::to($service_url)
            ->withHeaders($newHeaders)                    
            ->withData($inputData);

        if ($reqMethod == 'GET') {
            $response = $curl->returnResponseObject()->get();
        } elseif ($reqMethod == 'POST') {
            $response = $curl->returnResponseObject()->post();
        } elseif ($reqMethod == 'PUT') {
            $response = $curl->returnResponseObject()->put();
        } elseif ($reqMethod == 'DELETE') {
            $response = $curl->returnResponseObject()->delete();
        } elseif ($reqMethod == 'PATCH') {
            $response = $curl->returnResponseObject()->patch();
        }
        if ($response == null && $response->status != 200) {
            return response()->json([
                'ServerMsg' => 'match http method fail'
            ], 500);
        }
        
        return response($response->content,$response->status);
    }
}
