<?php
namespace App\Http\Controllers;

use App\Modules;
use App\User;
use Illuminate\Http\Request;
use App\Classes;
use Illuminate\Support\Str;
class ClassesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index(){
        $classes = Classes::where('user_id',auth()->id())->get();
        $modules = Modules::where('user_id',auth()->id())->get();
        return view('classes.index',['modules'=>$modules,'classes'=>$classes]);
    }
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'string|min:3'
        ],
            [
                'name.min'=>'This name too shot'
            ]);
        $classes = new Classes();
        $classes->name = $request->get('name','');
        $classes->user_id = auth()->id();
        $classes->module_id = $request->get('module','');
        $classes->code = Str::random(5);
        $classes->save();
        return redirect('classes')->with('message','Add new question success');
    }

    public function show($class_id){
        $classes = Classes::find($class_id);
        $users = $classes->students;
        return view('classes.students',['users'=>$users,'classes'=>$classes]);
    }
}
