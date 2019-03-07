<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $table = "question";

    public function test{
    	return $this->belongsToMany('App\Test','question_test','id_question','id_test');
    }

    public function selection{
    	return $this->hasMany('App\Selection','id_question');
    }
}
