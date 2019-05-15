<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function profile(Request $request){
        $user =User::where('id',auth()->id())->first();
        $user->name = $request->name_profile;
        $user->id_student = $request->id_student;
        $user->email = $request->email_profile;
        if ($request->new_password != ""){
            $user->password = bcrypt($request->new_password);
        }
        $user->save();
        return redirect()->back();
    }
}
