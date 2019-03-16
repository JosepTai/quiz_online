<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    //
    protected $table = "classes";

    public function teacher(){
        return $this->belongsTo('App\Users','user_id','id');
    }

    public function module(){
        return $this->belongsTo('App\Modules','module_id','id');
    }

    public function  exams(){
        return $this->hasMany('App\Exams','class_id','id');
    }

    public function students(){
        return $this->belongsToMany('App\Users','class_user','class_id','id');
    }
}
