<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Class extends Model
{
    //
    protected $table = "class";

    public function class_test{
    	return $this->hasMany('App\Class_Test','id_class','id');
    }

     public function user{
    	return $this->hasMany('App\User','class_user','id_class','id_user');
    }
}
