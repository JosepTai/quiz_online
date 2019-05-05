<?php

namespace App\Http\Controllers;

use App\Chapters;
use App\Classes;
use App\Exam_User;
use App\Exams;
use App\Modules;
use App\Parts;
use App\Configs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function index()
    {
        $classes = Classes::where('user_id', auth()->id())->get();
        $exams = auth()->user()->exams;
        return view('exams.index', ['exams' => $exams, 'classes' => $classes]);
    }

    public function store(Request $request)
    {
        $start_time = substr($request->start_time, 6, 4) . '-' . substr($request->start_time, 0, 2) . '-' . substr($request->start_time, 3, 2) . ' 00:00:00';
        $end_time = substr($request->end_time, 6, 4) . '-' . substr($request->end_time, 0, 2) . '-' . substr($request->end_time, 3, 2) . ' 23:59:59';
        $this->validate($request, [
            'title' => 'string|min:3'
        ],
            [
                'title.min' => 'This name too shot'
            ]);
        $exam = new Exams();
        $exam->title = $request->get('title', '');
        $exam->class_id = $request->get('class', '');
        $exam->duration = $request->get('duration', '');
        $exam->status = 'close';
        $exam->start_time = $start_time;
        $exam->end_time = $end_time;
        $exam->save();

        return redirect('exams')->with('message', 'Add new exam success');
    }

    public function show($exam_id)
    {
        $exam = Exams::where('id', $exam_id)->first();
        $title = $exam->title;
        $class = $exam->belongsToClass;
        $users = $class->students;
        $infors = array();
        foreach ($users as $user){
            $arr = Exam_User::where(['exam_id'=>$exam_id, 'user_id'=>$user->id])->get()->toArray();
            $infors = array_merge($infors, $arr);
        }

//        print_r($infors);
//        die();
       return view('exams.show',['users'=>$users,'infors'=>$infors,'title'=>$title]);
    }
}
