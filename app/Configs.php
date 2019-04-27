<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Configs extends Model
{
    //
    protected $table = 'configs';

    public function exam(){
        return $this->belongsTo('App\Exams','exam_id','id');
    }

    public function questions(){
        return $this->belongsToMany('App\Questions','config_question','config_id','question_id')->withPivot('config_id','user_id');
    }
    public  function getRandom($part_id, $level, $amount){
        $question = DB::table('questions')
            ->where('part_id',$part_id)
            ->where('level',$level)
            ->inRandomOrder()->limit($amount)
            ->select('id')
            ->get();
        return $question;
    }
}
