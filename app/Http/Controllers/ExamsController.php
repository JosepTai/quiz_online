<?php

namespace App\Http\Controllers;

use App\Chapters;
use App\Classes;
use App\Exams;
use App\Modules;
use App\Parts;
use App\Tests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function index()
    {
        $classes = Classes::where('user_id', auth()->id())->get();
        $exams = auth()->user()->exams;
        return view('exams.index', ['exams' => $exams, 'classes' => $classes]);
    }

    public function store(Request $request)
    {
        $start_time = substr($request->start_time, 6, 4) . '-' . substr($request->start_time, 0, 2) . '-' . substr($request->start_time, 3, 2) . ' 00:00:00';
        $end_time = substr($request->end_time, 6, 4) . '-' . substr($request->end_time, 0, 2) . '-' . substr($request->end_time, 3, 2) . ' 23:59:59';
        $this->validate($request, [
            'title' => 'string|min:3'
        ],
            [
                'title.min' => 'This name too shot'
            ]);
        $exam = new Exams();
        $exam->title = $request->get('title', '');
        $exam->class_id = $request->get('class', '');
        $exam->duration = $request->get('duration', '');
        $exam->status = 'close';
        $exam->start_time = $start_time;
        $exam->end_time = $end_time;
        $exam->save();

        return redirect('exams')->with('message', 'Add new exam success');
    }

    public function config($exam_id)
    {
        $exam = Exams::where('id', $exam_id)->first();
        $chapters = $exam->belongsToClass->module->chapters;
        $parts = Parts::all();
        $tests = Tests::where('exam_id',$exam_id)->get();
        $count = Tests::where('exam_id',$exam_id)->count();
        return view('exams.config', ['chapters' => $chapters, 'parts' => $parts, 'exam' => $exam,'tests'=>$tests,'count'=>$count]);
    }

    /**
     * @param Request $request
     */
    public function storeConfig(Request $request)
    {
        $input = $request->input();
        $exam = $request->get('exam', '');
        $count= $count = Tests::where('exam_id',$exam)->count();
        $part = $input['part'];
        $dem = 0;
        $part_id = 0;
        $easy = 0;
        $hard = 0;
        foreach ($part as $key => $item) {
            if ($dem == 0) {
                $part_id = $item;
                $dem++;
            } elseif ($dem == 1) {
                $easy = $item;
                $dem++;
            } elseif ($dem == 2) {
                $hard = $item;
                $dem = 0;
                if ($count == 0) {
//                  add questions esay amount
                    $test1 = new Tests();
                    $test1->exam_id = $exam;
                    $test1->part_id = $part_id;
                    $test1->level = "easy";
                    $test1->amount = $easy;
//                add questions hard amount
                    $test2 = new Tests();
                    $test2->exam_id = $exam;
                    $test2->part_id = $part_id;
                    $test2->level = "hard";
                    $test2->amount = $hard;
                    $test1->save();
                    $test2->save();
                } else {
//                    esay
                    Tests::where([
                        ['exam_id', '=', $exam],
                        ['part_id', '=', $part_id],
                        ['level', '=', 'easy'],
                    ])->update(['amount'=> $easy]);
//                    hard
                    Tests::where([
                        ['exam_id', '=', $exam],
                        ['part_id', '=', $part_id],
                        ['level', '=', 'hard'],
                    ])->update(['amount'=> $hard]);
                }
            }
        }
        return redirect()->back()->with('message', 'Config Success!');
    }
}
