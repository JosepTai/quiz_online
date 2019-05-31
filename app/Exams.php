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
            ->select('questions.id as id','questions.kind as kind','questions.image as image','questions.content as content', 'config_question.user_selected as selected')
            ->get();
        return $questions;
    }

//    public function export($exam_id){
//        $result = DB::table('exam_user')
//            ->join('exams','exams.id','=','exam_user.exam_id')
//            ->join('classes','exams.class_id',"=","classes.id")
//            ->join('class_user',"classes.id","=","class_user.class_id")
//            ->join('users',"class_user.user_id","=","users.id")
//            ->where(['exam_user.exam_id'=>$exam_id])
//            ->select(['users.name as name','users.id_student as id_student','users.email as email',
//                    'exam_user.start_time as start_time','exam_user.end_time as end_time','exam_user.score as score'])
//            ->orderBy("users.name",'=','asc')
//            ->get();
//        return $result;
//    }

}
