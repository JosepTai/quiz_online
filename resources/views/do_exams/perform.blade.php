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
            opacity: 0.5;
            z-index: 999;
            overflow: hidden;
            float: right;
            position: fixed;
            margin-left: 78%;
            margin-right: 3%;
            border-radius: 5px;
        }

        .countdown:hover {
            opacity: 1;
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
            padding: 5px;
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
        <div class="card-footer row action">
            <div class="col-md-6">
                <button onclick="clickSave()" type="submit" class="btn btn-primary "> Save</button>
            </div>
            <div class="col-md-6">
                <button  id="click_submit" onclick="clickSubmit()" type="submit" class="btn btn-success "> End
                    Test
                </button>
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
        @php
            $count=1;
        @endphp
        <form action="{{route('do_exams.successPerform')}}" method="POST" name="form">
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <input hidden type="text" id="time_end" name="end_test" value="no">
            <input hidden type="text" name="exam" value="{{$exam->id}}">
            @foreach($questions as $question)
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">Question {{$count}} : {{$question->content}}</h3>
                    </div>
                    <div class="card-body">
                        @php
                            foreach ($answers as $answer){
                                if ($answer['question_id'] == $question->id){
                                 $ans =0;
                                    foreach ($selects as $select){
                                        if ($question->id == $select->question_id){
                                            $strings  = $select->user_selected;
                                            $nums = explode(" ", $strings);
                                            if (count($nums)>1){
                                                for ($i = 1; $i < count($nums); $i++){
                                                    if ($answer['id'] == $nums[$i]){
                                                        echo '<label class="btn btn-default ans ">
                                                                <input checked type="checkbox" name="ques_'.$question->id.'[]"
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
                                        echo '<label class="btn btn-default ans ">
                                                <input type="checkbox" name="ques_'.$question->id.'[]"
                                                   value="'.$answer['id'].'"/>' .$answer['content'] .'</label><br>';
                                    }
                                }
                            }
                        @endphp
                    </div>
                </div>
            @endforeach
            <div hidden class="btndiv row">
                <div class="col-md-6">
                    <button id="btnSave" type="submit" class="btn btn-success "></button>
                </div>
                <div class="col-md-6">
                    <button id="btnSubmit" type="submit" class="btn btn-success "></button>
                </div>
            </div>
        </form>
    </div>
@endsection

{{--Countdown Script--}}
@section('script')
    <script>
        setTimeout(function () {
            document.getElementById('click_submit').disabled = false;
        }, 10000);

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

        var deadline = new Date(Date.parse(new Date()) + '<?= $seconds ?>' * 1000);
        initializeClock('clockdiv', deadline);
    </script>
    <script>
        function clickSave() {
            document.getElementById("btnSave").click();
        }

        function clickSubmit() {
            document.getElementById("time_end").value = 'yes';
            document.getElementById("btnSubmit").click();
        }

    </script>
@endsection