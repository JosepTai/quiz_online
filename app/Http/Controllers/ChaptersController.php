<?php

namespace App\Http\Controllers;

use App\Modules;
use Illuminate\Http\Request;
use App\Chapters;
use App\Parts;
class ChaptersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index(){
        $modules = Modules::where('user_id',auth()->id())->get();
        $chapters = auth()->user()->chapters;
        return view('chapters.index',['chapters'=>$chapters,'modules'=>$modules]);
    }
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'string|min:3'
        ],
            [
                'name.min'=>'This name too shot'
            ]);
        $chapters = new Chapters();
        $chapters->name = $request->get('name','');
        $chapters->module_id = $request->get('module','');
        $chapters->save();

        return redirect()->back()->with('message','Add new question success');
//        return redirect('chapters')->with('message','Add new question success');
    }
    public function show($chapter_id){
        $title = Chapters::find($chapter_id);
        $modules = Modules::where('user_id',auth()->id())->get();
        $parts = Parts::where('chapter_id', '=', $chapter_id)->get();
        return view('parts.index',['modules'=>$modules,'parts'=>$parts,'count'=>1,'title'=>$title]);
    }
    public function update(Request $request){
        $chapter = Chapters::where('id', $request->id_update)->first();
        $chapter->name = $request->name_update;
        $chapter->save();
        return redirect()->back();
    }
}
