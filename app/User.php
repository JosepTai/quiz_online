<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
        return $this->belongsToMany('App\Class','class_user','id_user','id_class');
    }

    public function teacher()
    {
        return $this->hasMany('App\Classes','user_id','id');
    }

    public function exam_user()
    {
        return $this->hasMany('App\Exam_User','user_id','id');
    }

    public function module()
    {
        return $this->hasMany('App\Modules','user_id','id');
    }
}
