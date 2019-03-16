<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exams extends Model
{
    //
    protected $table = "exams";

    public function class(){
        return $this->belongsTo('App\Classes','class_id','id');
    }

    public function user(){
        return $this->hasMany('App\Exam_User','exam_id','id');
    }

    public function questions(){
        return $this->belongsToMany('App\Questions','exam_question','exam_id','id');
    }
}
