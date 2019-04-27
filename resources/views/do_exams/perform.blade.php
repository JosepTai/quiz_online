@extends('layouts.index')
@section('content')
    @if(session('message'))
        <div class="alert alert-success" id="message">
            {{session('message')}}
        </div>
    @endif
    {{--    count down time--}}
    <style>
        .countdown {
            z-index: 999;
            overflow: hidden;
            float: right;
            position: fixed;
            margin-left: 79.5%;
            border-radius: 5px;
        }

        #clockdiv {
            font-family: sans-serif;
            color: #fff;
            display: inline-block;
            font-weight: 100;
            text-align: center;
            font-size: 30px;
        }

        #clockdiv > div {
            padding: 10px;
            border-radius: 3px;
            display: inline-block;
        }

        #clockdiv div > span {
            padding: 15px;
            border-radius: 3px;
            display: inline-block;
        }

        .smalltext {
            padding-top: 5px;
            font-size: 16px;
        }
    </style>
    <div class="countdown bg-gradient-success card">
        <div id="clockdiv">
            <div>
                <span class="hours"></span>
                <div class="smalltext">Hours</div>
            </div>
            <div>
                <span class="minutes"></span>
                <div class="smalltext">Minutes</div>
            </div>
            <div>
                <span class="seconds"></span>
                <div class="smalltext">Seconds</div>
            </div>
        </div>
        <div class="card-footer row">
            <div class="col-md-6">
                <button onclick="clickSave()" type="submit" class="btn btn-primary "> Save</button>
            </div>
            <div class="col-md-6">
                <button onclick="clickSubmit()" type="submit" class="btn btn-success "> End Test</button>
            </div>
        </div>
    </div>
    @php
        $seconds = 0;
        $diff = strtotime($end_time) - strtotime(now());
        if ($diff >0) $seconds = $diff ;
    @endphp
    {{--    end count down time--}}
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
        @php($count=1)
        <form action="{{route('do_exams.index',$exam->id)}}" method="GET" name="form">
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            @foreach($questions as $question)
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">Question {{$count}} : {{$question->content}}</h3>
                    </div>
                    <div class="card-body">
                        <label class="btn btn-default">
                            <input type="radio" id="1" name="{{$question->config_id}}"
                                   value="{{$question->answer_1}}"/> {{$question->answer_1}}
                        </label><br>
                        <label class="btn btn-default">
                            <input type="radio" id="2" name="{{$question->config_id}}"
                                   value="{{$question->answer_2}}"/> {{$question->answer_2}}
                        </label><br>
                        <label class="btn btn-default">
                            <input type="radio" id="3" name="{{$question->config_id}}"
                                   value="{{$question->answer_3}}"/> {{$question->answer_3}}
                        </label><br>
                        <label class="btn btn-default">
                            <input type="radio" id="4" name="{{$question->config_id}}"
                                   value="{{$question->answer_4}}"/> {{$question->answer_4}}
                        </label>
                    </div>
                </div>
                @php($count++)
            @endforeach
            <button type="submit" class="btn btn-success">Add</button>
            <div class="btndiv row">
                <div class="col-md-6">
                    <button id="btnSave" type="submit" class="btn btn-success "> Sadfve</button>
                </div>
                <div class="col-md-6">
                    <button id="btnSubmit" type="submit" class="btn btn-success "> End tedfdfst</button>
                </div>
            </div>
        </form>
    </div>
@endsection

{{--Ajax load chapter when choose module--}}
@section('script')
    <script>
        function getTimeRemaining(endtime) {
            var t = Date.parse(endtime) - Date.parse(new Date());
            var seconds = Math.floor((t / 1000) % 60);
            var minutes = Math.floor((t / 1000 / 60) % 60);
            var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
            return {
                'total': t,
                'hours': hours,
                'minutes': minutes,
                'seconds': seconds
            };
        }

        function initializeClock(id, endtime) {
            var clock = document.getElementById(id);
            var daysSpan = clock.querySelector('.days');
            var hoursSpan = clock.querySelector('.hours');
            var minutesSpan = clock.querySelector('.minutes');
            var secondsSpan = clock.querySelector('.seconds');

            function updateClock() {
                var t = getTimeRemaining(endtime);
                hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
                minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
                secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

                if (t.total <= 0) {
                    clearInterval(timeinterval);
                    document.getElementById("btnSubmit").click();
                }
            }
            updateClock();
            var timeinterval = setInterval(updateClock, 1000);
        }

        var deadline = new Date(Date.parse(new Date()) + '<?= $seconds ?>'* 1000);
        initializeClock('clockdiv', deadline);
    </script>
    <script>
        function clickSave() {
            document.getElementById("btnSave").click();
        }

        function clickSubmit() {
            document.getElementById("btnSubmit").click();
        }

    </script>
@endsection