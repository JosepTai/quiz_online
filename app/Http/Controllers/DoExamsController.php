<?php

namespace App\Http\Controllers;

use App\Classes;
use App\Exams;
use Illuminate\Http\Request;
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
        foreach ($classes as $class){
            $arr = Exams::where('class_id',$class->id)->get()->toArray();
            $exams = array_merge($exams,$arr);
        }
        return view('do_exams.index', ['exams' => $exams, 'classes' => $classes]);
    }
    public function perform($exam_id){
        return view('do_exams.perform');
    }
}
