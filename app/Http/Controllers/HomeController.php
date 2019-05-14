<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $modules = DB::table('modules')
            ->where('user_id',auth()->id())
            ->count();
        $classes = DB::table('classes')
            ->where('user_id',auth()->id())
            ->count();
        $questions = DB::table('questions')
            ->where('user_id',auth()->id())
            ->count();
        $exams = DB::table('exams')
            ->join('classes','exams.class_id','=','classes.id')
            ->where('classes.user_id',auth()->id())
            ->count();
        return view('home.index',['modules'=>$modules,'classes'=>$classes,'questions'=>$questions,'exams'=>$exams]);
    }
}
