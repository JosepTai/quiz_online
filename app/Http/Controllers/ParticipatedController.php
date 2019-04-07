<?php

namespace App\Http\Controllers;

use App\Classes;
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
    public function leaveClass($class_id){
        Auth::user()->student()->detach($class_id);
        $classes = auth()->user()->student;
        return view('participated.index',['classes'=>$classes]);
    }
}
