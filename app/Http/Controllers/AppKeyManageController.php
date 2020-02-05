<?php

namespace App\Http\Controllers;
use App\AppKeyManage;
use Illuminate\Http\Request;

class AppKeyManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $AppKeys =  AppKeyManage::all();
        return view('admin.app_key_manage',['AppKeys'=>$AppKeys]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return 'create';
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
        $appName = $request->appName;
        $appPWD = $request->appPWD;
        $freeReq = $request->freeReq;
        if($appName!='' && $appPWD!=''){
            $AKM = new AppKeyManage();
            $AKM->name = $appName;
            $AKM->key = $appPWD;
            $AKM->free_request_times_pre_day = $freeReq;
            $AKM->save();
        }        
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return 'show';
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
        return 'edit';
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
        $AKM = AppKeyManage::find($id);
        $AKM->key = $request->appPWD;
        $AKM->free_request_times_pre_day = $request->freeReq;
        $AKM->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //        
        AppKeyManage::find($id)->delete();
        return back();   
    }
}
