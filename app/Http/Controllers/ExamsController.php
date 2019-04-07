<?php

namespace App\Http\Controllers;

use App\Chapters;
use App\Classes;
use App\Exams;
use App\Modules;
use App\Parts;
use Illuminate\Http\Request;

class ExamsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index(){
        $classes = Classes::where('user_id',auth()->id())->get();
        $exams = auth()->user()->exams;
        return view('exams.index',['exams'=>$exams,'classes'=>$classes]);
    }
    public function store(Request $request){
        $start_time = substr($request->start_time,6,4).'-'.substr($request->start_time,0,2).'-'.substr($request->start_time,3,2).' 00:00:00';
        $end_time = substr($request->end_time,6,4).'-'.substr($request->end_time,0,2).'-'.substr($request->end_time,3,2).' 23:59:59';
        $this->validate($request,[
            'title'=>'string|min:3'
        ],
            [
                'title.min'=>'This name too shot'
            ]);
        $exams = new Exams();
        $exams->title = $request->get('title','');
        $exams->class_id = $request->get('class','');
        $exams->duration = $request->get('duration','');
        $exams->status = 'close';
        $exams->start_time = $start_time;
        $exams->end_time = $end_time;
        $exams->save();

        return redirect('exams')->with('message','Add new exam success');
    }
    public function config($exam_id){
        $exam = Exams::where('id',$exam_id);
        $chapters = $exam->belongsToClass;
//        $parts = Parts::all();
//        return view('exams.config',['chapters'=>$chapters,'parts'=>$parts,'exam'=>exam]);
    }

}
