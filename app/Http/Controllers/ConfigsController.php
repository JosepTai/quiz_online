<?php

namespace App\Http\Controllers;

use App\Classes;
use App\Configs;
use App\Exams;
use App\Parts;
use App\Questions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ConfigsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($exam_id)
    {
        $exam = Exams::where('id', $exam_id)->first();
        if ($exam->status == "configed")
            return redirect()->back();
        else {
            $chapters = $exam->belongsToClass->module->chapters;
            $parts = Parts::all();
            $configs = Configs::where('exam_id', $exam_id)->get();
            $count = Configs::where('exam_id', $exam_id)->count();
            return view('exams.config', ['chapters' => $chapters, 'parts' => $parts, 'exam' => $exam, 'configs' => $configs, 'count' => $count]);
        }

    }

    public function storeConfig(Request $request)
    {
        $input = $request->input();
        $exam_id = $request->get('exam', '');
        $exam = Exams::where('id', $exam_id)->first();
        $exam->status = 'configed';
        $exam->save();
        $count = $count = Configs::where('exam_id', $exam_id)->count();
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
                    $test1 = new Configs();
                    $test1->exam_id = $exam_id;
                    $test1->part_id = $part_id;
                    $test1->level = "easy";
                    $test1->amount = $easy;
//                add questions hard amount
                    $test2 = new Configs();
                    $test2->exam_id = $exam_id;
                    $test2->part_id = $part_id;
                    $test2->level = "hard";
                    $test2->amount = $hard;
                    $test1->save();
                    $test2->save();
                } else {
//                    esay
                    Configs::where([
                        ['exam_id', '=', $exam_id],
                        ['part_id', '=', $part_id],
                        ['level', '=', 'easy'],
                    ])->update(['amount' => $easy]);
//                    hard
                    Configs::where([
                        ['exam_id', '=', $exam_id],
                        ['part_id', '=', $part_id],
                        ['level', '=', 'hard'],
                    ])->update(['amount' => $hard]);
                }
            }
        }
        $classes = Classes::where('user_id', auth()->id())->get();
        $exams = auth()->user()->exams;
        return view('exams.index', ['exams' => $exams, 'classes' => $classes]);
    }
}
