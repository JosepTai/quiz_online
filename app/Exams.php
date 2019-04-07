<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exams extends Model
{
    //
    protected $table = "exams";

    public function belongsToClass(){
        return $this->belongsTo('App\Classes','class_id','id');
    }

    public function users(){
        return $this->hasMany('App\Exam_User','exam_id','id');
    }

    public function tests(){
        return $this->hasMany('App\Test','exam_id','id');
    }
}
