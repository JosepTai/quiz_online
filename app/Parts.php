<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parts extends Model
{
    //
    protected $table = "parts";

    public function chapter(){
        return $this->belongsTo('App\Chapters','chapter_id','id');
    }

    public function questions(){
        return $this->belongsToMany('App\Questions','part_question','part_id','id');
    }
}
