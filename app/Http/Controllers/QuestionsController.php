<?php

namespace App\Http\Controllers;

use App\Answers;
use App\Chapters;
use App\Imports\QuestionsImport;
use App\Modules;
use App\Parts;
use Illuminate\Http\Request;
use App\Questions;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class QuestionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //getList
    public function index()
    {
        $modules = Modules::where('user_id', auth()->id())->get();
        $chapters = Chapters::all();
        $parts = auth()->user()->parts();
        $questions = Questions::where('user_id', auth()->id())->get();
        $active = "questions";
        return view('questions.index', ['modules' => $modules, 'chapters' => $chapters, 'parts' => $parts, 'questions' => $questions, 'active' => $active]);
    }

    //postAdd
    public function store(Request $request)
    {
        $questions = new Questions();
        $questions->content = $request->get('content', '');
        $questions->level = $request->get('level', '');
        $questions->user_id = auth()->id();
        $questions->part_id = $request->get('part', '');
        $questions->save();
//       add answers for question
        $ques_id = DB::table('questions')
            ->max('id');
        $arr = $request->is_answer;
        for ($i = 1; $i <= $request->amount; $i++) {
            $ans = "answer_" . $i;
            $count = 0;
            for ($j = 0; $j < count($arr); $j++) {
                if ($arr[$j] == $i) {
                    $answer = new Answers();
                    $answer->question_id = $ques_id;
                    $answer->content = $request->$ans;
                    $answer->is_correct = 1;
                    $answer->save();
                    $count++;
                };
            }
            if ($count == 0) {
                $answer = new Answers();
                $answer->question_id = $ques_id;
                $answer->content = $request->$ans;
                $answer->is_correct = 0;
                $answer->save();
            }
        }
        return redirect('questions')->with('message', 'Add new question success');
    }

    public function import(Request $request)
    {
        $arrays = Excel::toArray(new QuestionsImport(), request()->file('file'));
        foreach ($arrays as $array) {
            for ($i = 0; $i < count($arrays[0]); $i++) {
                //get value
                $content = $array[$i][0];
                $level = $array[$i][1];
                $part_id = $request->part;
                $amount = $array[$i][2];
                $is_correct = explode(",",$array[$i][3]);
                //add question
                $question = new Questions();
                $question->level = $level;
                $question->part_id = $part_id;
                $question->user_id = auth()->id();
                $question->content = $content;
                $question->save();
                //add answer
                $ques_id = DB::table('questions')
                    ->max('id');
                for ($j = 1; $j<=$amount; $j++){
                    $answer = new Answers();
                    $answer->question_id = $ques_id;
                    $answer->content = $array[$i][$j+3];
                    $dem=0;
                    for ($k = 0; $k<count($is_correct); $k++){
                        if ($is_correct[$k] == $j){
                            $answer->is_correct = 1;
                            $dem++;
                            break;
                        }
                    }
                    if ($dem == 0) $answer->is_correct = 0;
                    $answer->save();
                }
            }
        }
        return $this->index()->with('message', 'Add new questions from file success');
    }
}