<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAuthLimit extends Model
{
    //
    public $incrementing = false;
    public function appKeyManage(){
        return $this->belongsTo('App\AppKeyManage','app_id','id');
    }
}
