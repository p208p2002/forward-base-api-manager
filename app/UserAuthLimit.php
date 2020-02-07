<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAuthLimit extends Model
{
    //
    public $incrementing = false;
    protected $primaryKey = ['uid', 'app_id'];
    public function appKeyManage()
    {
        return $this->belongsTo('App\AppKeyManage', 'app_id', 'id');
    }
    //
    /**
     * Set the keys for a save update query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function setKeysForSaveQuery(Builder $query)
    {
        $query->where($this->getKeyName(), '=', $this->getKeyForSaveQuery());
        $query->where('secondKeyName', $this->secondKeyName); // <- added line

        return $query;
    }
}
