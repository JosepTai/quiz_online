<?php
namespace App\Http\Controllers;

use App\Exams;
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

    public function students($class_id){
        $classes = Classes::find($class_id);
        $students = $classes->students;
        return view('classes.students',['students'=>$students,'classes'=>$classes]);
    }
    public function show_exam($id){
        $arr = explode(" ", $id);
        $class_id = $arr[0];
        $student_id = $arr[1];
        $class = Classes::where('id',$class_id)->first();
        $students = User::where('id',$student_id)->first();
        $exams = $students->exam_class($class_id);
        $all_exams = Exams::where('class_id',$class_id)->get();
        return view('participated.show',['exams'=>$exams,'all_exams'=>$all_exams,'class'=>$class,'student_name'=>$students->name]);
    }
}
