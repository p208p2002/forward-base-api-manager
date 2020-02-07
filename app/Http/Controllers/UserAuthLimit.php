<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\AppKeyManage;
use App\UserAuthLimit as UAL;
use Illuminate\Foundation\Console\Presets\React;
use Illuminate\Http\Request;

class UserAuthLimit extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $query = $request->q;
        if($query == null){
            $users = USER::latest()->limit(30)->get();
        }
        else{
            $users = USER::where('email',$query)->get();
            // User::where('email',$query)->first()->appAuth;
        }
        $AKM = AppKeyManage::all();
        return view('admin.user_auth_limit',["users"=>$users,"AKM"=>$AKM]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $users = USER::where('email',$request->email)->get();
        $AKM = AppKeyManage::all();
        return view('admin.user_auth_limit',["users"=>$users,"AKM"=>$AKM]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($email)
    {
        //
        return view('admin.user_auth_limit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 撤銷使用者權限
        $uid = Auth::user()->id;
        $app_id = $id;
        UAL::where('uid',$uid)->where('app_id',$app_id)->delete();
        return back();
    }

    public function addAuth(Request $request){
        $giveAuth = $request->giveAuth;
        $giveAuth = explode(',', $giveAuth);

        if($giveAuth == ''){
            return back();
        }
        
        $uid = $giveAuth[1];
        $userAuthLimit = new UAL();
        $userAuthLimit->uid = $uid;
        $userAuthLimit->app_id = $giveAuth[0];
        $appFreeRequestPreDay = AppKeyManage::where('id',$giveAuth[0])->first()->free_request_times_pre_day;
        $userAuthLimit->free_remain_request_times_pre_day = $appFreeRequestPreDay;
        $userAuthLimit->save();

        return back();
    }
}
