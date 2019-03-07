<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    //
    protected $table = "status";

    public function class_test{
    	return $this->belongsToMany('App\Class_Test','class_test_status','id_status','id_class_test');
    }

    public function test_user{
    	return $this->belongsToMany('App\Test_User','status_test_user','id_status','id_test_user');
    }
}
