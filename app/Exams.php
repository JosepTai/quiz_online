<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Exams extends Model
{
    //
    protected $table = "exams";

    public function belongsToClass()
    {
        return $this->belongsTo('App\Classes', 'class_id', 'id');
    }

    public function users()
    {
        return $this->hasMany('App\Exam_User', 'exam_id', 'id');
    }

    public function configs()
    {
        return $this->hasMany('App\Configs', 'exam_id', 'id');
    }

    public function questions($exam_id)
    {
        $questions = DB::table('exams')
            ->join('configs', 'exams.id', '=', 'configs.exam_id')
            ->join('config_question', 'configs.id', '=', 'config_question.config_id')
            ->join('questions', 'config_question.question_id', '=', 'questions.id')
            ->where(['exams.id'=>$exam_id,'config_question.user_id'=>auth()->id()])
            ->select('questions.id as id', 'questions.content as content', 'config_question.user_selected as selected')
            ->get();
        return $questions;
    }

}
