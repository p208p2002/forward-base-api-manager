<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAuthLimit extends Model
{
    //
    public $incrementing = false;
    protected $primaryKey = ['uid','app_id'];
    public function appKeyManage(){
        return $this->belongsTo('App\AppKeyManage','app_id','id');
    }
}
