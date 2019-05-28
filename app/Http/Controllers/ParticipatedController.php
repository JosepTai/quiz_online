<?php

namespace App\Http\Controllers;

use App\Classes;
use App\Exam_User;
use App\Exams;
use App\Http\Controllers\Auth\AuthController;
use App\Modules;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParticipatedController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index(){
        $classes = auth()->user()->student;
        return view('participated.index',['classes'=>$classes]);
    }

    public function joinClass(Request $request)
    {
        $user = Auth::user();
        $countClass = $user->classes()->where('id', $request->class)->count();
        if ($countClass == 0){
            $user->student()->attach($request->class);
            return redirect('participated');
        } else{
            return redirect('participated');
        }
    }
    public function show($class_id){
        $class = Classes::where('id',$class_id)->first();
        $user = User::where('id',auth()->id())->first();
        $exams = $user->exam_class($class_id);
        $all_exams = Exams::where('class_id',$class_id)->get();
        return view('participated.show',['exams'=>$exams,'all_exams'=>$all_exams,'class'=>$class]);
    }

}
