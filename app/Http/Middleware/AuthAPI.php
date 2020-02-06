<?php

namespace App\Http\Middleware;

use App\User;
use App\AppKeyManage;
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
        // 檢查用戶是否存在
        $user = User::where('api_token', $request->header('Authorization'))->first();
        if($user == null){
            return response()->json([
                'ServerMsg' => 'authorization access deny, token mismatch.'
            ], 403);
        }
        
        // 檢查該用戶是否擁有存取權限
        $targetApp = $request->header('AppName');
        $AKM = AppKeyManage::where('name', $targetApp)->first();
        $userAppAuth =  $user->appAuth->where('app_id', $AKM->id)->first();
        
        if ($userAppAuth == null) {
            return response()->json([
                'ServerMsg' => 'access denied, user has no authority for this app'
            ], 403);
        }

        // 檢查是否還有可請求次數
        $free_remain_request_times_pre_day = $userAppAuth->free_remain_request_times_pre_day;
        $remain_request_times = $userAppAuth->remain_request_times;
        // dd($free_remain_request_times_pre_day,$remain_request_times);
        if($free_remain_request_times_pre_day == 0  && $remain_request_times ==0){
            return response()->json([
                'ServerMsg' => 'api request times limit'
            ], 402);
        }

        // all pass
        return $next($request);
    }
}
