<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chapters;
class ChaptersController extends Controller
{
    //
    public function getList($id){
        $chapters = Chapters::where('module_id', $id);
        return view('admin.modules.chapters.list',['chapters'=>$chapters]);
    }
    public function getAdd(){

    }
}
