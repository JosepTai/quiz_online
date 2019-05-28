<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function student()
    {
        return $this->belongsToMany('App\Classes','class_user','user_id','class_id')->withPivot("updated_at");
    }

    public function teacher()
    {
        return $this->hasMany('App\Classes','user_id','id');
    }


    public function modules()
    {
        return $this->hasMany('App\Modules','user_id','id');
    }
    public function exams()
    {
        return $this->hasManyThrough('App\Exams','App\Classes','user_id','class_id','id','');
    }
    public  function exam_class($class_id){
        $exam_class = Exams::query()
            ->join('exam_user','exams.id','=','exam_user.exam_id')
            ->where(['exam_user.user_id'=>auth()->id(), 'exams.status'=>'configed', 'exams.class_id'=>$class_id])
            ->select('exams.id as id','exams.title as title','exams.duration as duration','exams.start_time as start_time', 'exams.end_time as end_time',
                                'exam_user.start_time as start_at','exam_user.end_time as end_at', 'exam_user.score as score')
            ->get();
        return $exam_class;
    }
    public function chapters()
    {
        return $this->hasManyThrough('App\Chapters','App\Modules','user_id','module_id','id','');
    }
    public function parts()
    {
        $parts = Parts::query()
            ->join('chapters', 'parts.chapter_id', '=', 'chapters.id')
            ->join('modules', 'chapters.module_id', '=', 'modules.id')
            ->where('modules.user_id',auth()->id())
            ->select('parts.id as id','parts.name as name','parts.chapter_id','parts.created_at','parts.updated_at', 'chapters.name as chapter_name','modules.name as module_name')
            ->get();
        return $parts;
    }

    public function classes()
    {
        return $this->belongsToMany(Classes::class, 'class_user', 'user_id', 'class_id');
    }

}
