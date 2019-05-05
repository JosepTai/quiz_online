@extends('layouts.index')
@section('content')
    @if(session('message'))
        <div class="alert alert-success" id="message">
            {{session('message')}}
        </div>
    @endif

    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Exams</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{route('exams.index')}}">Exams</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Do Exams</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6 row">
        <div class="col-lg-3"></div>
        <div class="card col-lg-6">
            <div class="card-header">
                <h1 style="text-align: center">Congratulations you completed the exam</h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-8">
                        <h2>{{$exam->title}}</h2><br>
                        <lable>Class: &emsp; {{$exam->belongsToClass->name}}</lable>
                        <br><br>
                        <lable>Start at: &emsp; {{$exam_user->start_time}}</lable>
                        <br><br>
                        <lable>End at: &emsp; {{$exam_user->end_time}}</lable>
                        <br>
                    </div>
                    <div style="text-align: center; margin-top: 40px;" class="col-3">
                        <lable>Your Score</lable>
                        <h1 style="margin-top: 10px; font-size: 55px;">{{$score}}</h1>
                    </div>
                </div>
            </div>
            @if ($exam->end_time > now())
                <div class="row card-footer"  >
                        <a href="{{route('do_exams.index')}}" style="color: #ffffff" class="btn btn-primary btn-lg btn-block">Back to all exams</a>
                </div>
            @else
                <div class="row card-footer"  >
                    <div class="col-md-6">
                        <a href="{{route('do_exams.index')}}" style="color: #ffffff" class="btn btn-primary btn-lg btn-block">Back to all exams</a>
                    </div>
                    <div class="col-md-6">
                        <a style="color: #ffffff" href="{{route('do_exams.show_result',$exam->id)}}" class="btn btn-success btn-lg btn-block">Show answer</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
