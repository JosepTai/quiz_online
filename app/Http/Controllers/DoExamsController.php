<?php

namespace App\Http\Controllers;

use App\Answers;
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
                return $this->result($exam_id);
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
        $answers = Answers::all();
        $answ = array();
        foreach ($questions as $question) {
            foreach ($answers as $answer) {
                if ($question->id == $answer->question_id) {
                    $answ[] = $answer->toArray();
                }
            }
        }
        shuffle($answ);
        $exam_user = Exam_User::where(['exam_id' => $exam_id, 'user_id' => auth()->id()])->first();
        $end_time = $exam_user->end_time;
        $title = $exam->title;
        $selects = DB::table('config_question')
            ->join('configs', 'config_question.config_id', '=', 'configs.id')
            ->join('exams', 'exams.id', '=', 'configs.exam_id')
            ->where(['exams.id' => $exam->id, 'config_question.user_id' => auth()->id()])
            ->select('config_question.question_id as question_id', 'config_question.user_selected as user_selected')->get();
        return view('do_exams.perform', ['exam' => $exam, 'questions' => $questions, 'answers' => $answ, 'title' => $title, 'selects' => $selects, 'end_time' => $end_time]);
    }


    public function successPerform(Request $request)
    {
        $exam_user = Exam_User::where(['exam_id' => $request->exam, 'user_id' => auth()->id()])->first();
        $start = $exam_user->start_time;
        if ($exam_user->end_time < now()) {
            return $this->result($request->exam);
        } else {
            $exam = Exams::where('id', $request->exam)->first();
            $questions = $exam->questions($request->exam);
            foreach ($questions as $question) {
                $q = "ques_" . $question->id;
                $ques = $request->$q;
                $selected = '';
                if (!empty($ques)) {
                    for ($i = 0; $i < count($ques); $i++) {
                        $selected = $selected . ' ' . $ques[$i];
                    }
                }
                DB::table('config_question')
                    ->join('configs', 'config_question.config_id', '=', 'configs.id')
                    ->where(['configs.exam_id' => $exam->id, 'config_question.question_id' => $question->id, 'config_question.user_id' => auth()->id()])
                    ->update(['config_question.user_selected' => "$selected"]);
            }
            $questions = $exam->questions($exam->id);
            $answers = Answers::all();
            $answ = array();
            foreach ($questions as $question) {
                foreach ($answers as $answer) {
                    if ($question->id == $answer->question_id) {
                        $answ[] = $answer->toArray();
                    }
                }
            }
            shuffle($answ);
            $selects = DB::table('config_question')
                ->join('configs', 'config_question.config_id', '=', 'configs.id')
                ->join('exams', 'exams.id', '=', 'configs.exam_id')
                ->where(['exams.id' => $exam->id, 'config_question.user_id' => auth()->id()])
                ->select('config_question.question_id as question_id', 'config_question.user_selected as user_selected')->get();
            $title = $exam->title;
            if ($request->end_test == "yes") {
                $exam_user->end_time = now();
                $exam_user->save();
            }
            return view('do_exams.perform', ['exam' => $exam, 'questions' => $questions, 'answers' => $answ, 'title' => $title, 'selects' => $selects, 'end_time' => $exam_user->end_time]);
        }
    }

    public function result($exam_id)
    {
        $exam = Exams::where('id', $exam_id)->first();
        $exam_user = Exam_User::where(['exam_id' => $exam_id, 'user_id' => auth()->id()])->first();
        if (empty($exam_user)) {
            $score = 0;
            return view('do_exams.result', ['exam' => $exam, 'score' => $score, 'exam_user' => $exam_user]);
        } else {
            $questions = $exam->questions($exam->id);
            $selects = DB::table('config_question')
                ->join('configs', 'config_question.config_id', '=', 'configs.id')
                ->join('exams', 'exams.id', '=', 'configs.exam_id')
                ->where(['exams.id' => $exam->id, 'config_question.user_id' => auth()->id()])
                ->select('config_question.question_id as question_id', 'config_question.user_selected as user_selected')->get();
            $count = 0;
            $answers = Answers::all();
            $answs = array();
            foreach ($questions as $question) {
                foreach ($answers as $answer) {
                    if ($question->id == $answer->question_id) {
                        $answs[] = $answer->toArray();
                    }
                }
            }
            foreach ($selects as $select) {
                $strings = $select->user_selected;
                $nums = explode(" ", $strings);
                $ans = 0;
                $sec = 0;
                foreach ($answs as $answ) {
                    if ($answ['question_id'] == $select->question_id) {
                        if ($answ['is_correct'] == 1) $ans++;
                    }
                }
                for ($i = 0; $i < count($nums); $i++) {
                    foreach ($answs as $answ) {
                        if ($answ['id'] == $nums[$i]) {
                            if ($answ['is_correct'] == 1) $sec++;
                        }
                    }
                }
                if ($ans == $sec) $count++;
            }
            if ($count == 0) $score = 0;
            else $score = round((10 / count($selects) * $count), 2);
            $exam_user->score = $score;
            $exam_user->save();
            return view('do_exams.result', ['exam' => $exam, 'score' => $score, 'exam_user' => $exam_user]);
        }

    }

    public function show_result($exam_id)
    {
        $exam = Exams::where('id', $exam_id)->first();
        if ($exam->end_time > now()) return $this->result($exam_id);
        else {
            $questions = $exam->questions($exam->id);
            $answers = Answers::all();
            $arr = array();
            foreach ($questions as $question) {
                foreach ($answers as $answer) {
                    if ($question->id == $answer->question_id) {
                        $arr[] = $answer->toArray();
                    }
                }
            }
            shuffle($arr);
            $title = $exam->title;
            $selects = DB::table('config_question')
                ->join('configs', 'config_question.config_id', '=', 'configs.id')
                ->where(['configs.exam_id' => $exam->id])
                ->select('config_question.question_id as question_id', 'config_question.user_selected as user_selected')->get();
            return view('do_exams.show_result', ['exam' => $exam, 'questions' => $questions, 'answers' => $answers, 'selects' => $selects, 'title' => $title]);
        }

    }
}
