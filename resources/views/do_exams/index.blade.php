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
                    <div class="col-lg-6 col-5 text-right">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 fix-top">
                            <h1 class="page-header">
                                <button style="float:right;" onclick="show()" class=" btn btn-success">Fillter</button>
                                <select style="width: 200px; float: right;margin-right: 10px" class="form-control" id="show">
                                    <option value="0">Show All</option>
                                    <option value="1">Time has not yet arrived</option>
                                    <option value="2">Happening</option>
                                    <option value="3">Finished</option>
                                </select>

                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            @foreach($exams as $exam)
                @if ($exam['start_time'] > now())
                    @php($type = "default")
                @elseif ($exam['end_time'] < now())
                    @php($type = "danger")
                @else
                    @php($type = "success")
                @endif
                <div  class="col-lg-3  is_{{$type}}">
                    <div class="card">
                        <!-- Card header -->
                        <div  class=" card-header bg-gradient-{{$type}}">
                            <h3 style="color: #ffffff; text-align: center;"
                                class="mb-0 fc-content">{{$exam['title']}}</h3>
                        </div>
                        <!-- Card body -->
                        <div class="card-body">
                            <!-- Classs -->
                            <div class="row">
                                <div class="col-lg-3">
                                    <label> Class: </label>
                                </div>
                                <div class="col-lg-9">
                                    @foreach($classes as $class)
                                        @if ($exam['class_id']==$class->id)
                                            <label> {{$class->name}}</label>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <!-- Duration -->
                            <div class="row">
                                <div class="col-lg-6">
                                    <label> Duration: </label>
                                </div>
                                <div class="col-lg-6">
                                    <label> {{$exam['duration']}} minutes</label>
                                </div>
                            </div>
                            <!-- Time -->
                            <div class="row">
                                <div class="col-lg-6">
                                    <label>Start At</label><br>
                                    <label> {{$exam['start_time']}}</label>
                                </div>
                                <div class="col-lg-6">
                                    <label>End At</label><br>
                                    <label> {{$exam['end_time']}}</label>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent">
                                @if ($type =="danger")
                                    <a href="{{route('do_exams.result',$exam['id'])}}"
                                       class=" btn btn-outline-danger btn-block">Show
                                        result</a>
                                @elseif ($type == "default")
                                    <div class="row">
                                        <div class="col-lg-1">
                                            <i class="ni ni-time-alarm">
                                            </i>
                                        </div>
                                        <div class="col-lg-11">
                                            <span>The time for exam has not started</span>
                                        </div>
                                    </div>
                                @else
                                    <a target="_blank" rel="noopener noreferrer" href="{{route('do_exams.perform',$exam['id'])}}"
                                       class=" btn btn-outline-success btn-block">Do
                                        It</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@section('script')
    <script>
        function show() {
            $(document).ready(function(){
                var x = document.getElementById('show').value;
                if (x == 0){
                    $(".is_danger").show();
                    $(".is_success").show();
                    $(".is_default").show();
                }
                else if(x == 1){
                    $(".is_danger").hide();
                    $(".is_success").hide();
                    $(".is_default").show();
                }
                else if(x == 2){
                    $(".is_danger").hide();
                    $(".is_success").show();
                    $(".is_default").hide();
                }
                else{
                    $(".is_danger").show();
                    $(".is_success").hide();
                    $(".is_default").hide();
                }
            });
        }
    </script>
@endsection
