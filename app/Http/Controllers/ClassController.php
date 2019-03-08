<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\_Class;
class ClassController extends Controller
{
    //
    public function getList()
    {
    	$class = _Class::all();
    	return view('admin.class.list',['class'=>$class]);
    }
    // 
    public function getAdd()
    {
    	return view('admin.class.add');
    }
    public function postAdd(Request $request)
    {
    	$this->validate($request,[
    		'name'=>'required|unique:class,name|min:3|max:100'
    	],
    	[
    		'name.required'=>'Please enter name class!',
    		'name.unique'=> 'This class already exists!',
    		'name.min'=>'Class name must be longer than 3 characters',
    		'name.max'=>'Class name must be shorter than 100 characters'
    	]);
    	$class->save();

    	return redirect('admin/class/add')->with('thongbao','Them Thanh Cong');
    }
    // 
    public function getEdit($id)
    {
    	$class = _Class::find($id);
    	return view('admin.class.edit',['class'=>$class]);
    }
    public function postEdit(Request $request, $id)
    {
    	$class =  _class::find($id);
    	$this->validate($request,[
    		'name'=>'required|unique:class,name|min:3|max:100'
    	],
    	[
    		'name.required'=>'Please enter name class!',
    		'name.unique'=> 'This class already exists!',
    		'name.min'=>'Class name must be longer than 3 characters',
    		'name.max'=>'Class name must be shorter than 100 characters'
    	]);
    	$class->save();
    	return redirect('admin/class/edit/' .$id)->with('thongbao','Sua thanh cong');
    }

    public function getXoa($id){

    	$class = _Class::find($id);
    	$class->delete();

    	return redirect('admin/class/list')->with('thongbao','Ban da xoa thanh cong '.$class->name);
    }
}
