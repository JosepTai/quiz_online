<?php

namespace App\Http\Controllers;

use App\Chapters;
use App\Classes;
use App\Exam_User;
use App\Exams;
use App\Exports\Exam_UserExport;
use App\Modules;
use App\Parts;
use App\Configs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

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
        $time = "";
        $start_time = substr($request->start_time, 6, 4) . '-' . substr($request->start_time, 0, 2) . '-' . substr($request->start_time, 3, 2);
        $end_time = substr($request->end_time, 6, 4) . '-' . substr($request->end_time, 0, 2) . '-' . substr($request->end_time, 3, 2);
        if ($request->is_test == "on") {
            $time = $request->time;
            $hours = substr($time, 0, 2);
            $minutes = substr($time, 3, 5);
            $start_time = $start_time . ' ' . $hours . ':' . $minutes . ':00';
            $duration = $request->duration;
            $hours = $hours + round($duration / 60);
            $minutes = $minutes + round($duration % 60);
            $end_time = $end_time . ' ' . $hours . ':' . $minutes . ':00';
        } else {
            $start_time = $start_time . ' 00:00:00';
            $end_time = $end_time . ' 23:59:59';
        }
        $exam = new Exams();
        $exam->title = $request->get('title', '');
        $exam->class_id = $request->get('class', '');
        $exam->duration = $request->get('duration', '');
        $exam->status = 'close';
        $exam->start_time = $start_time;
        $exam->end_time = $end_time;
        $exam->save();
        $this_exam = DB::table('exams')
            ->max('id');
        return redirect()->route('configs.index', $this_exam);
    }

    public function show($exam_id)
    {
        $exam = Exams::where('id', $exam_id)->first();
        $title = $exam->title;
        $class = $exam->belongsToClass;
        $users = $class->students;
        $infors = array();
        foreach ($users as $user) {
            $arr = Exam_User::where(['exam_id' => $exam_id, 'user_id' => $user->id])->get()->toArray();
            $infors = array_merge($infors, $arr);
        }

        return view('exams.show', ['users' => $users, 'infors' => $infors, 'title' => $title, 'exam' => $exam]);
    }

    public function export($exam_id)
    {
        $exam = Exams::where("id", $exam_id)->first();
        $array = Array(
            0 => Array(
                0 => $exam->title . "( " . $exam->start_time . ")",
            ),
            1 => Array(
                0 => ""
            ),
            2 => Array(
                0 => "Name",
                1 => "Student ID",
                2 => "Email",
                3 => "Start Time",
                4 => "End Time",
                5 => "Score",
            )
        );

        $class = $exam->belongsToClass;
        $users = $class->students;
        $infors = array();
        foreach ($users as $user) {
            $arr = Exam_User::where(['exam_id' => $exam_id, 'user_id' => $user->id])->get()->toArray();
            $infors = array_merge($infors, $arr);
        }
        foreach ($users as $user) {
            $arr = array();
            $arr[0] = $user->name;
            $arr[1] = $user->id_student;
            $arr[2] = $user->email;
            $count = 0;
            foreach ($infors as $infor){
                if ($infor['user_id'] == $user->id){
                    $arr[3] = $infor['start_time'];
                    $arr[4] = $infor['end_time'];
                    $arr[5] = $infor['score'];
                    $count++;
                }
            }
            if ($count == 0){
                $arr[3] = "";
                $arr[4] = "";
                $arr[5] = 0;
            }
            array_push($array, $arr);
        }
        $name = $exam->title."_".$class->name."( ".$exam->start_time.").xls";
        header("Content-Disposition: attachment; filename=\"$name\"");
        header("Content-Type: application/vnd.ms-excel;");
        header("Pragma: no-cache");
        header("Expires: 0");
        $out = fopen("php://output", 'w');
        foreach ($array as $data) {
            fputcsv($out, $data, "\t");
        }
        fclose($out);
    }
}
