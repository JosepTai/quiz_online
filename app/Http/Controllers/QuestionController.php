<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\question;
class QuestionController extends Controller
{
    //
     public function getList()
    {
    	$question = Question::all();
    	return view('admin.question.list',['question'=>$question]);
    }
    public function getEdit($id)
    {
    	 $question = Question::find($id);
    	return view('admin.question.edit',['question'=>$question]);
        // return $question;
    }
    public function postEdit(Request $request, $id)
    {
    	$question =  Question::find($id);
    	$this->validate($request,[
    		'content'=>'unique:question,content|min:3'
    	],
    	[
    		'content.unique'=> 'This question already exists!',
    		'content.min'=>'The content of the question must not be too short',
    	]);
        $question->content = $request->content;
        $question->answer_1 = $request->answer_1;
        $question->answer_2 = $request->answer_2;
        $question->answer_3 = $request->answer_3;
        $question->answer_4 = $request->answer_4;
        $question->correct_answer =  $request->correct_answer;
    	$question->save();
    	return redirect('admin/question/edit/' .$id)->with('message','The question was successfully edited');
    }

}
