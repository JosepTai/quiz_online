<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tests extends Model
{
    //
    protected $table = 'tests';

    public function exam(){
        return $this->belongsTo('App\Exams','exam_id','id');
    }

    public function questions(){
        return $this->belongsToMany('App\Questions','question_test','test_id','question_id');
    }
}
