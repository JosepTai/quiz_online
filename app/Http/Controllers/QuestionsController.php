<?php

namespace App\Http\Controllers;

use App\Chapters;
use App\Modules;
use App\Parts;
use Illuminate\Http\Request;
use App\Questions;
class QuestionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //getList
    public function index(){
        $modules = Modules::where('user_id',auth()->id())->get();
        $chapters = Chapters::all();
        $parts = auth()->user()->parts();
        $questions = Questions::where('user_id',auth()->id())->get();
        return view('questions.index',['modules'=>$modules,'chapters'=>$chapters,'parts'=>$parts,'questions'=>$questions]);
    }
    //postAdd
    public function store(Request $request){
        $this->validate($request,[
            'content'=>'required|unique:Questions,content|min:3'
        ],
            [
                'content.min'=>'This content too shot'
            ]);
       $questions = new Questions();
       $questions->content = $request->get('content', '');
       $questions->level = $request->get('level', '');
       $questions->user_id = auth()->id();
       $questions->part_id = $request->get('part', '');
       $questions->answer_1 = $request->get('answer_1', '');
       $questions->answer_2 = $request->get('answer_2', '');
       $questions->answer_3 = $request->get('answer_3', '');
       $questions->answer_4 = $request->get('answer_4', '');
       $questions->correct_answer = $request->get('correct_answer', '');

       $questions->save();

        return redirect('questions')->with('message','Add new question success');
    }
}
