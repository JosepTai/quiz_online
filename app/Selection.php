<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Selection extends Model
{
    //
    protected $table = "selection";

    public function question()
    {
    	return $this->hasmany('App\Question','id_question','id');
    }

    public function test_user()
    {
    	return $this->belongsToMany('App\Test_User','selection_test_user','id_selection','id_test-user');
    }
}
