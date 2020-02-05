<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppKeyManage extends Model
{
    //
    protected $table = 'app_key_table';
    public $timestamps = false;

    public function appLimit(){
        return $this->hasMany('App\UserAuthLimit','app_id','id');
    }
}
