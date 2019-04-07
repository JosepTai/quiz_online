<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules;
use App\Chapters;
class ModulesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //index
    public function index(){
        $modules = Modules::where('user_id',auth()->id())->get();
        return view('modules.index',['modules'=>$modules]);
    }
    //show
    public function show($module_id){
        $modules = Modules::where('user_id',auth()->id())->get();
        $chapters = Chapters::where('module_id',$module_id)->get();
        return view('chapters.index',['chapters'=>$chapters,'modules'=>$modules]);
    }

    //store
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'string|min:3'
        ],
        [
            'name.min'=>'This name too shot'
        ]);
        $modules = new Modules();
        $modules->name = $request->get('name','');
        $modules->user_id = auth()->id();
        $modules->save();

        return redirect('modules')->with('message','Add new question success');
    }
}
