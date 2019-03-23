<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Results extends Model
{
    //
    protected $table = "results";

    public function question(){
        return $this->belongsTo('App\Questions','question_id','id');
    }

    public function exam_user(){
        return $this->belongsTo('App\Exam_User','exam_user_id','id');
    }
}
