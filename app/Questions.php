<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    //
    protected $table = 'questions';
    public function part(){
        return $this->belongsTo('App\Parts','part_id','id');
    }

    public function exam(){
        return $this->belongsToMany('App\Exams','exam_question','question_id','id');
    }

    public function result(){
        return $this->hasMany('App\Results','question_id','id');
    }
}
