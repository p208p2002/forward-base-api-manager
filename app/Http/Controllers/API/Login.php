<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Hash;

class Login extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //取得token
    public function __invoke(Request $request)
    {
        $account = $request->input('account');
        $password = $request->input('password');

        if($account == null || $password == null){
            return response()->json([
                'ServerMsg' => 'account or password can not be null'
            ],400);
        }

        $user = DB::table('users')
        ->where([
            ['email','=',$account]            
        ])
        ->first();        
        
        $checkPWD = Hash::check($password, $user->password);
        if($checkPWD){
            return response()->json([
                'Token' => $user->api_token,
            ]);
        }

        return response()->json([
            'ServerMsg'=>'login fail'
        ],403);
    }
}
