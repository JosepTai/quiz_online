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
                                <li class="breadcrumb-item"><a>Exam</a></li>
                                <li class="breadcrumb-item"><a>Do Exam</a></li>
                                <li class="breadcrumb-item"><a>{{$title}}</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        @php
            $count=1;
            $num =[1,2,3,4];
        @endphp
        <div>
            @foreach($questions as $question)
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">Question {{$count}} : {{$question->content}}</h3>
                    </div>
                    <div class="card-body">
                        @php
                            foreach ($answers as $answer){
                                if ($answer['question_id'] == $question->id){
                                    foreach ($selects as $select){
                                        if ($question->id == $select->question_id){
                                            if ($answer['is_correct'] == 1) echo '<label class="btn btn-success ans">';
                                            else echo '<label class="btn btn-default ans">';
                                            if ($answer['content'] == $select->user_selected){
                                                echo '<input checked type="radio" name="ques_'.$question->id.'"
                                                           value="'.$answer['content'].'"/>' .$answer['content'] .'</label><br>';
                                                           break;
                                            }else{
                                                echo ' <input type="radio" name="ques_'.$question->id.'"
                                                           value="'.$answer['content'].'"/>' .$answer['content'] .'</label><br>';
                                                           break;
                                            }
                                        }
                                    }
                                }
                            }
                        @endphp
                    </div>
                </div>
                @php
                    $count++;
                    $num =[1,2,3,4];
                @endphp
            @endforeach
        </div>
    </div>
@endsection
