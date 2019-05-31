<?php

namespace App\Http\Controllers;

use App\Answers;
use App\Chapters;
use App\Exam_User;
use App\Imports\QuestionsImport;
use App\Modules;
use App\Parts;
use Illuminate\Http\Request;
use App\Questions;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\Console\Input\Input;

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
        return view('questions.index', ['modules' => $modules, 'chapters' => $chapters, 'parts' => $parts, 'questions' => $questions]);
    }

    //postAdd
    public function store(Request $request)
    {
        if (empty($request->image)) $imageName=null;
        else{
            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images'), $imageName);
        }
        $arr = $request->is_answer;
        $questions = new Questions();
        $questions->content = $request->get('content', '');
        $questions->level = $request->get('level', '');
        if (count($arr) == 1) $questions->kind = 0;
        else $questions->kind = 1;
        $questions->image = $imageName;
        $questions->user_id = auth()->id();
        $questions->part_id = $request->get('part', '');
        $questions->save();
//       add answers for question
        $ques_id = DB::table('questions')
            ->max('id');

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
            for ($i = 1; $i < count($arrays[0]); $i++) {
                //get value
                $content = $array[$i][0];
                $level = $array[$i][1];
                $part_id = $request->part;
                $amount = $array[$i][2];
                $is_correct = explode(",", $array[$i][3]);
                //add question
                $question = new Questions();
                $question->level = $level;
                if (count($is_correct) == 1) $question->kind = 0;
                else $question->kind = 1;
                $question->part_id = $part_id;

                $question->user_id = auth()->id();
                $question->content = $content;
                $question->save();
                //add answer
                $ques_id = DB::table('questions')
                    ->max('id');
                for ($j = 1; $j <= $amount; $j++) {
                    $answer = new Answers();
                    $answer->question_id = $ques_id;
                    $answer->content = $array[$i][$j + 3];
                    $dem = 0;
                    for ($k = 0; $k < count($is_correct); $k++) {
                        if ($is_correct[$k] == $j) {
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
        return redirect()->back()->with('message', 'Add new question success');
    }

    public function show($question_id){
        $question = Questions::where('id',$question_id)->first();
        $answers = Answers::where('question_id',$question_id)->get();
        $count = DB::table('config_question')
                    ->where('question_id',$question_id)
                    ->count();
        return view('questions.show',['question'=>$question, 'answers'=>$answers,'count'=>$count]);
    }

    public function destroy($question_id)
    {
        $question = Questions::where('id', $question_id)->first();
        $answers = Answers::all();
        foreach ($answers as $answer) {
            if ($answer->question_id == $question->id)
                $answer->delete();
        }
        $question->delete();
        return redirect()->back();
    }
}