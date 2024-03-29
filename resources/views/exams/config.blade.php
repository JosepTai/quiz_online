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
                                <li class="breadcrumb-item active" aria-current="page">{{$exam->title}} (
                                    Class: {{$exam->belongsToClass->name}})
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Config</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <!-- Card body -->
        <div class="card-body">
            <!-- Form groups used in grid -->
            <form action="{{route('configs.storeConfig')}}" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <input type="hidden" name="exam" value="{{$exam->id}}"/>
                @foreach($chapters as $chapter)
                    <div class=" card form-group">
                        <div class="card-header">
                            <label class="form-control-label"><h2>Chapter: {{$chapter->name}}</h2></label>
                        </div>
                        <br><br>
                        @foreach($chapter->parts as $part)
                            @php
                                $easy_max = 0;
                                $hard_max = 0;
                                foreach ($questions as $question){
                                    if ($question->part_id == $part->id){
                                        if ($question->level == "easy") $easy_max++;
                                        else $hard_max++;
                                    }
                                }
                            @endphp
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-2"><label for="example-text-input"
                                                             class="col-md-12 col-form-label form-control-label"><b>Part: </b>{{$part->name}}
                                    </label></div>
                                <input type="hidden" name="part[]" value="{{$part->id}}"/>
                                <div class="col-md-1"></div>
                                <div class="col-md-3 row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-4">
                                        <label style="float: left"
                                               class="col-form-label form-control-label"> Easy
                                            questions</label>
                                    </div>
                                    <div class="col-md-6">
                                        @php( $countEasy = 0)
                                        @foreach($configs as $config)
                                            @if ($part->id == $config->part_id && $config->level == "easy")
                                                <input name="part[]" class="form-control" value="{{$config->amount}}"
                                                       type='number' min='0' max="{{$easy_max}}" onkeypress='return false;'/>
                                                @php( $countEasy = 1)
                                                @break
                                            @endif
                                        @endforeach
                                        @if($countEasy == 0)
                                            <input name="part[]" class="form-control" value="0" type='number'
                                                   min='0' max='{{$easy_max}}' onkeypress='return false;'/>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3 row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-4">
                                        <label style="float: left" class="col-form-label form-control-label">
                                            Hard
                                            questions</label>
                                    </div>
                                    <div class="col-md-6">
                                        @php( $countHard = 0)
                                        @foreach($configs as $config)
                                            @if ($part->id == $config->part_id && $config->level == "hard")
                                                <input name="part[]" class="form-control" value="{{$config->amount}}"
                                                       type='number' min='0' max='{{$hard_max}}' onkeypress='return false;'/>
                                                @php( $countHard = 1)
                                                @break
                                            @endif
                                        @endforeach
                                        @if($countHard == 0)
                                            <input name="part[]" class="form-control" value="0" type='number'
                                                   min='0' max='{{$hard_max}}' onkeypress='return false;'/>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                @endforeach
                <div style="float: right">
                    <button type="submit" class="btn btn-success">Apply</button>
                </div>
                <br><br>
            </form>
        </div>
    </div>
    </div>

@endsection
