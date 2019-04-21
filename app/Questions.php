<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    //
    protected $table = 'questions';
    protected $guarded=[];
    public function part(){
        return $this->belongsTo('App\Parts','part_id','id');
    }

    public function results(){
        return $this->hasMany('App\Results','question_id','id');
    }

    public function tests(){
        return $this->belongsToMany('App\Tests','question_test','question_id','test_id');
    }
}
