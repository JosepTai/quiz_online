<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Questions;
class QuestionsController extends Controller
{
    //
    public function getList(){
        $questions = Questions::all();
        return view('admin.questions.list',['questions'=>$questions]);
    }

}
