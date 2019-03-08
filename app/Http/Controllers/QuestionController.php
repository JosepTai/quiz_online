<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\question;
class QuestionController extends Controller
{
    //
     public function getList()
    {
    	$question = Question::all();
    	return view('admin.question.list',['question'=>$question]);
    }
    public function getEdit($id)
    {
    	$question = Question::find($id);
    	return view('admin.question.list',['question'=>$question]);
    }
    public function postEdit(Request $request, $id)
    {
    	$question =  Question::find($id);
    	$this->validate($request,[
    		'Ten'=>'required|unique:tintuc,Ten|min:3|max:100'
    	],
    	[
    		'Ten.required'=> 'Ban chua nhap ten the loai',
    		'Ten.unique'=> 'Ten the loai nay da ton tai',
    		'Ten.min'=>'Ten the loai phai lon hon 3',
    		'Ten.max'=>'Ten the loai phai nho hon 100'
    	]);
    	$tintuc->save();
    	return redirect('admin/tintuc/sua/' .$id)->with('thongbao','Sua thanh cong');
    }

}
