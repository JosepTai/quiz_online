<?php

namespace App\Http\Controllers;

use App\Chapters;
use App\Modules;
use App\Parts;
use App\Questions;
use Illuminate\Http\Request;

class PartsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index(){
        $modules = Modules::where('user_id',auth()->id())->get();
        $parts = auth()->user()->parts();
        return view('parts.index',['modules'=>$modules,'parts'=>$parts]);
    }
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'string|min:3'
        ],
            [
                'name.min'=>'This name too shot'
            ]);
        $parts = new Parts();
        $parts->name = $request->get('name','');
        $parts->chapter_id = $request->get('chapter','');
        $parts->save();

        return redirect()->back()->with('message','Add new question success');
//        return redirect('parts')->with('message','Add new question success');
    }
    public function show($part_id){
        $title = Parts::Find($part_id);
        $questions = Questions::where('part_id',$part_id)->get();
        $modules = Modules::where('user_id',auth()->id())->get();
        $chapters = Chapters::all();
        $parts = auth()->user()->parts();
        return view('questions.index',['modules'=>$modules,'chapters'=>$chapters,'parts'=>$parts,'questions'=>$questions,'title'=>$title]);
    }
    public function update(Request $request){
        $part = Parts::where('id', $request->id_update)->first();
        $part->name = $request->name_update;
        $part->save();
        return redirect()->back();
    }
}
