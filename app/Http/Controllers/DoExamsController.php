<?php

namespace App\Http\Controllers;

use App\Classes;
use App\Configs;
use App\Exam_User;
use App\Exams;
use App\Questions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Array_;

class DoExamsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function index()
    {
        $classes = auth()->user()->classes;
        $exams = array();
        foreach ($classes as $class) {
            $arr = Exams::where('class_id', $class->id)->get()->toArray();
            $exams = array_merge($exams, $arr);
        }
        return view('do_exams.index', ['exams' => $exams, 'classes' => $classes]);
    }

    public function perform($exam_id)
    {
        $exam = Exams::where('id', $exam_id)->first();
        $exam_user = Exam_User::where(['exam_id' => $exam_id, 'user_id' => auth()->id()])->first();
        if (empty($exam_user)) {
            $new_exam_user = new Exam_User();
            $new_exam_user->exam_id = $exam_id;
            $new_exam_user->user_id = auth()->id();
            $new_exam_user->start_time = Carbon::now();
            $hours = floor(($exam->duration) / 60);
            $minutes = ($exam->duration) % 60;
            $new_exam_user->end_time = Carbon::now()->addMinutes($minutes)->addHours($hours);
            $new_exam_user->score = 0;
            $new_exam_user->save();

//            create test
            $cfs = Configs::where('exam_id', $exam_id)->get();
            foreach ($cfs as $config) {
                $count = 0;
                $checks = $config->questions;
                foreach ($checks as $check) {
                    if ($check->pivot->config_id == $config->id && $check->pivot->user_id == auth()->id()) $count++;
                }
                if ($count == 0) {
                    $count = $config->amount;
                    $Arr = $config->getRandom($config->part_id, $config->level, $config->amount);
                    echo $Arr;
                    foreach ($Arr as $arr) {
                        $config->questions()->attach($config->id, ['question_id' => $arr->id, 'user_id' => auth()->id()]);
                    }
                    echo $Arr;
                } else continue;
            }
        }
        // get question of exam
        $questions = $exam->questions($exam_id);
        $exam_user = Exam_User::where(['exam_id' => $exam_id, 'user_id' => auth()->id()])->first();
        $end_time = $exam_user->end_time;
        $title = $exam->title;
        return view('do_exams.perform', ['exam' => $exam, 'questions' => $questions, 'title' => $title,'end_time'=>$end_time]);
    }
}
