<?php

namespace App\Http\Controllers;

use App\Chapters;
use App\Classes;
use App\Modules;
use App\Parts;
use App\User;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    //
    public function getChapter(Request $request)
    {
        if ($request->ajax()) {
            $chapters = Chapters::where('module_id',$request->module_id)->select('id', 'name')->get();
            return response()->json($chapters);
        }
    }
    public function getPart(Request $request)
    {
        if ($request->ajax()) {
            $patrs = Parts::where('chapter_id',$request->chapter_id)->select('id', 'name')->get();
            return response()->json($patrs);
        }
    }
    public function getClass(Request $request)
    {
        if ($request->ajax()) {
            $classes = Classes::where('code',$request->code)->select('id', 'name')->get();
            return response()->json($classes);
        }
    }
}
