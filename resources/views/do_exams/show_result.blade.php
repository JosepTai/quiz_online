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
                                if ($answer['is_correct']==1) echo '<label  class="btn btn-success ans ">';
                                else echo '<label  class="btn btn-default ans ">';
                                 $ans =0;
                                    foreach ($selects as $select){
                                        if ($question->id == $select->question_id){
                                            $strings  = $select->user_selected;
                                            $nums = explode(" ", $strings);
                                            if (count($nums)>1){
                                                for ($i = 1; $i < count($nums); $i++){
                                                    if ($answer['id'] == $nums[$i]){
                                                        echo '<input disabled checked type="checkbox" name="ques_'.$question->id.'[]"
                                                                   value="'.$answer['id'].'"/>' .$answer['content'] .'</label><br>';
                                                        $ans++;
                                                        break;
                                                    }
                                                }
                                            }
                                        }
                                        if ($ans==1) break;
                                    }
                                    if ($ans==0){
                                        echo '<input disabled type="checkbox" name="ques_'.$question->id.'[]"
                                                   value="'.$answer['id'].'"/>' .$answer['content'] .'</label><br>';
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
