<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
class AuthAPI
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $header = $request->header('Authorization');
        $hasUser = DB::table('users')->where('api_token',$header)->first();
        if($hasUser != null)
            return $next($request);
        else            
            return response()->json([
                'ServerMsg' => 'authorization access deny'
            ],403);
    }
}
