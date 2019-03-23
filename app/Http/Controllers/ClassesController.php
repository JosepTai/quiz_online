<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes;
class ClassesController extends Controller
{
    //
    public function getList(){
        $classes = Classes::all();
        return view('admin.classes.list',['classes'=>$classes]);
    }
}
