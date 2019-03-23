<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    //
    protected $table = "status";

    public function exam_user(){
        return $this->belongsToMany('App\Exam_User','exam_user_status','status_id','id');
    }
}
