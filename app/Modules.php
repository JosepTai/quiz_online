<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modules extends Model
{
    //
    protected $table = "modules";

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

    public function classes(){
        return $this->hasMany('App\Classes','module_id','id');
    }

    public function chapters(){
        return $this->hasMany('App\Chapters','module_id','id');
    }
}
