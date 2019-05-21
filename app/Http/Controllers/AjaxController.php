<?php

namespace App\Http\Controllers;

use App\Answers;
use App\Chapters;
use App\Classes;
use App\Modules;
use App\Parts;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    //
    public function getChapter(Request $request)
    {
        if ($request->ajax()) {
            $chapters = Chapters::where('module_id',$request->module_id)->select('id', 'name')->get();
            return response()->json($chapters);
        }
    }
    public function getPart(Request $request)
    {
        if ($request->ajax()) {
            $patrs = Parts::where('chapter_id',$request->chapter_id)->select('id', 'name')->get();
            return response()->json($patrs);
        }
    }
    public function getClass(Request $request)
    {
        if ($request->ajax()) {
            $classes = Classes::where('code',$request->code)->select('id', 'name')->get();
            return response()->json($classes);
        }
    }
    public function check_question(Request $request)
    {
        if ($request->ajax()) {
            $question = DB::table('config_question')
                ->where('config_question.question_id','=',$request->question_id)
                ->count();
            return response()->json($question);
        }
    }
    public function show_detail(Request $request)
    {
        if ($request->ajax()) {
           $answers = Answers::where('question_id',$request->question_id)->get();
            return response()->json($answers);
        }
    }
}
