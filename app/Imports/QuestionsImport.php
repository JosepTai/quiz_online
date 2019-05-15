<?php

namespace App\Imports;

use App\Http\Requests\Request;
use App\Questions;
use Maatwebsite\Excel\Concerns\ToModel;
use phpDocumentor\Reflection\Types\Integer;

class QuestionsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
    }
}
