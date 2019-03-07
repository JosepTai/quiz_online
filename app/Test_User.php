<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test_User extends Model
{
    //
    protected $table = "test_user";

    public function user{
    	return $this->belongsTo('App\User','id','id_user');
    }

    public function selection{
    	return $this->belongsToMany('App\Selection','selection_test_user','id_test_user'.'id_selection');
    }

    public function status{
    	return $this->belongsToMany('App\Status','status_test_user','id_test_user','id_status');
    }
}
