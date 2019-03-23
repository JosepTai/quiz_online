<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Questions;
class QuestionsController extends Controller
{
    //getList
    public function getList(){
        $questions = Questions::all();
        return view('admin.questions.list',['questions'=>$questions]);
    }
    //getAdd
    public function getAdd(){
        return view('admin.questions.add');
    }
    //postAdd
    public function postAdd(Request $request){
        $this->validate($request,[
            'content'=>'required|unique:Questions,content|min:3'
        ],
            [
                'content.min'=>'This content too shot'
            ]);
       $questions = new Questions();
       $questions->content = $request->get('content', '');
       $questions->level = $request->level;
       $questions->answer_1 = $request->answer_1;
       $questions->answer_2 = $request->answer_2;
       $questions->answer_3 = $request->answer_3;
       $questions->answer_4 = $request->answer_4;
       $questions->correct_answer = $request->correct_answer;

       $questions->save();

        return redirect('admin/questions/add')->with('message','Add new question success');
    }
}
