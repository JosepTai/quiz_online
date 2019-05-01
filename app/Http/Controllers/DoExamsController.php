<?php

namespace App\Http\Controllers;

use App\Classes;
use App\Configs;
use App\Exam_User;
use App\Exams;
use App\Questions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        if (!empty($exam_user)) {
            if ($exam_user->end_time < now()) {
                return view('do_exams.result');
            }
        }
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
                    foreach ($Arr as $arr) {
                        $config->questions()->attach($config->id, ['question_id' => $arr->id, 'user_id' => auth()->id(), 'user_selected' => '']);
                    }
                } else continue;
            }
        }
        // get question of exam
        $questions = $exam->questions($exam_id);
        $exam_user = Exam_User::where(['exam_id' => $exam_id, 'user_id' => auth()->id()])->first();
        $end_time = $exam_user->end_time;
        $title = $exam->title;
        $selects = DB::table('config_question')
            ->join('configs', 'config_question.config_id', '=', 'configs.id')
            ->where(['configs.exam_id' => $exam->id])
            ->select('config_question.question_id as question_id', 'config_question.user_selected as user_selected')->get();
        return view('do_exams.perform', ['exam' => $exam, 'questions' => $questions, 'title' => $title,'selects'=>$selects,'end_time' => $end_time]);
    }


    public function successPerform(Request $request)
    {
        $configs = Configs::where('exam_id', $request->exam);
        $exam = Exams::where('id', $request->exam)->first();
        $questions = $exam->questions($request->exam);
        foreach ($questions as $question) {
            $q = "ques_" . $question->id;
            $ques = $request->$q;
            DB::table('config_question')
                ->join('configs', 'config_question.config_id', '=', 'configs.id')
                ->where(['configs.exam_id' => $exam->id, 'config_question.question_id' => $question->id, 'config_question.user_id' => auth()->id()])
                ->update(['config_question.user_selected' => "$ques"]);
        }
        $exam_user = Exam_User::where(['exam_id' => $request->exam, 'user_id' => auth()->id()])->first();
        $exam_user->end_time = $request->end_time;
        $exam_user->save();
        if ($exam_user->end_time < now()) {
            return view('do_exams.result');
        } else {
            $questions = $exam->questions($exam->id);
            $exam_user = Exam_User::where(['exam_id' => $exam->id, 'user_id' => auth()->id()])->first();
            $end_time = $exam_user->end_time;
            $title = $exam->title;
            $selects = DB::table('config_question')
                ->join('configs', 'config_question.config_id', '=', 'configs.id')
                ->where(['configs.exam_id' => $exam->id])
                ->select('config_question.question_id as question_id', 'config_question.user_selected as user_selected')->get();
            return view('do_exams.perform', ['exam' => $exam, 'questions' => $questions, 'title' => $title,'selects'=>$selects,'end_time' => $end_time]);
        }
    }
}
