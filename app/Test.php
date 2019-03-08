<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    //
    protected $table = "test";

    public function class()
    {
    	return $this->hasMany('App\Class_Test','id_test','id');
    }

    public function user()
    {
    	return $this->hasMany('App\Test_User','id_test','id');
    }

    public function question()
    {
    	return $this->belongsToMany('App\Question','question_test','id_test','id_question');
    }
}
