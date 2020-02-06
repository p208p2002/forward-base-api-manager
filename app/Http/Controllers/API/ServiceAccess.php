<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ixudra\Curl\Facades\Curl;
use App\AppKeyManage;
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
        $inputQuery = $request->query();
        $inputQueryUrl = '';
        if (count($inputQuery) != 0){
            $inputQueryUrl = '?'.http_build_query($inputQuery);
        }
        $inputData = $request->getContent(); //$request->getContent()
        $targetApp = $request->header('AppName');
        if ($targetApp == null) {
            return response()->json([
                'ServerMsg' => 'AppName can not be null in Header'
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
       
        $AKM = AppKeyManage::where('name',$targetApp)->first();
        if ($AKM == null) {
            return response()->json([
                'ServerMsg' => 'APP Name miss match, check your AppName'
            ], 400);
        }

        $appKey = $AKM->key;
        array_push($newHeaders, 'AppKey' . ':' . strval($appKey));
        $curl =  Curl::to($service_url.$inputQueryUrl)
            ->withHeaders($newHeaders)                    
            ->withData($inputData)
            ->withResponseHeaders()
            ->returnResponseObject();

        if ($reqMethod == 'GET') {
            $response = $curl->get();
        } elseif ($reqMethod == 'POST') {
            $response = $curl->post();
        } elseif ($reqMethod == 'PUT') {
            $response = $curl->put();
        } elseif ($reqMethod == 'DELETE') {
            $response = $curl->delete();
        } elseif ($reqMethod == 'PATCH') {
            $response = $curl->patch();
        }
        if ($response == null && $response->status != 200) {
            return response()->json([
                'ServerMsg' => 'match http method fail'
            ], 500);
        }
        
        return response($response->content,$response->status,$response->headers);
    }
}
