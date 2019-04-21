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

                <div class="col-lg-3">
                    <div class="card ">
                        <!-- Card header -->
                        <div class="card-header bg-gradient-{{$type}}">
                            <h3 style="color: #ffffff" class="mb-0 fc-content">{{$exam['title']}}</h3>
                        </div>
                        <!-- Card body -->
                        <div class="card-body">
                            <!-- Classs -->
                            <div class="row">
                                <div class="col-lg-3">
                                    <label> Class: </label>
                                </div>
                                <div class="col-lg-9">
                                    <label> abc</label>
                                </div>
                            </div>
                            <!-- Duration -->
                            <div class="row">
                                <div class="col-lg-3">
                                    <label> Duration: </label>
                                </div>
                                <div class="col-lg-9">
                                    <label> {{$exam['duration']}} minutes</label>
                                </div>
                            </div>
                            <br>
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
                                    <label class="heading-title text-warning mb-0">
                                        <small> This exam is end</small>
                                    </label>
                                @else
                                    <a href="{{route('do_exams.perform',$exam['id'])}}"
                                       class=" btn btn-outline-success">Do
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

{{--Ajax load chapter when choose module--}}
@section('script')
    <script type="text/javascript">
        var url = "{{ url('ajax/parts') }}";
        console.log(url);
        $("select[name='module']").change(function () {
            var module_id = $(this).val();
            var token = $("input[name='_token']").val();
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    module_id: module_id,
                    _token: token
                },
                success: function (data) {
                    $("select[name='chapter']").html('');
                    $.each(data, function (key, value) {
                        $("select[name='chapter']").append(
                            "<option value=" + value.id + ">" + value.name + "</option>"
                        );
                    });
                }
            });
        });
    </script>
@endsection