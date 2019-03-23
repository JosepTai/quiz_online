<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules;
class ModulesController extends Controller
{
    //getList
    public function getList(){
        $modules = Modules::where('user_id',auth()->id())->get();
        return view('admin.modules.list',['modules'=>$modules]);
    }
    //getAdd
    public function getAdd(){
        return view('admin.modules.add');
    }
    //postAdd
    public function postAdd(Request $request){
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

        return redirect('admin/modules/add')->with('message','Add new question success');
    }
}
