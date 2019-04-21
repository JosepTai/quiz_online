<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapters extends Model
{
    //
    protected $table = "chapters";

    public function module(){
        return $this->belongsTo('App\Modules','module_id','id');
    }
    public function parts(){
        return $this->hasMany('App\Parts','chapter_id','id');
    }
}
