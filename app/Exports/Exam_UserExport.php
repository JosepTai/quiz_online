<?php

namespace App\Exports;

use App\Exam_User;
use Maatwebsite\Excel\Concerns\FromCollection;

class Exam_UserExport implements FromCollection
{
    protected $exam_id;
    public function __construct($exam_id)
    {
        $this->exam_id;
    }

    /**
     * @return \Illuminate\Support\Collection
     */

    public function collection()
    {
        $exam_id = $this->exam_id;
        return Exam_User::where('exam_id',$exam_id)->get();
    }
}
