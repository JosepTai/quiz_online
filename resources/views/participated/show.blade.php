@extends('layouts.index')
@section('content')
    @if(session('message'))
        <div class="alert alert-success" id="message">
            {{session('message')}}
        </div>
    @endif
    @if(session('err'))
        <div class="alert alert-danger" id="err">
            {{session('err')}}
        </div>
    @endif

    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Classes</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                @if (isset($student_name))
                                    <li class="breadcrumb-item"><a
                                                href="{{route('classes.students',$class->id)}}">Classes: {{$class->name}}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a>{{$student_name}}</a></li>
                                @else
                                    <li class="breadcrumb-item"><a>Classes: {{$class->name}}</a></li>
                                @endif

                                <li class="breadcrumb-item"><a>All Exams</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="card mb-4">
            <div class="table-responsive py-4">
                <table class="table table-flush" id="datatable-basic">
                    <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Duaration</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Status</th>
                        <th>Start At</th>
                        <th>End At</th>
                        <th>Score At</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Duaration</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Status</th>
                        <th>Start At</th>
                        <th>End At</th>
                        <th>Score At</th>
                        <th></th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @php($arr = array())
                    @foreach($exams as $exam)
                        <tr>
                            <td>{{$exam->id}}</td>
                            <td>{{$exam->title}}</td>
                            <td class="next_line">{{$exam->duration}}</td>
                            <td class="next_line">{{$exam->start_time}}</td>
                            <td class="next_line">{{$exam->end_time}}</td>
                            @if ($exam->end_at > now())
                                <td class="next_line">Doing</td>
                            @else
                                <td class="next_line">Completed</td>
                            @endif
                            <td class="next_line">{{$exam->start_at}}</td>
                            <td class="next_line">{{$exam->end_at}}</td>
                            <td class="next_line">{{$exam->score}}</td>
                            @if ($exam->end_time > now())
                                <td>
                                    <a data-toggle="tooltip" data-original-title="The test has not ended"
                                       class="btn btn-info btn-sm"><i class="ni ni-fat-add"></i></a>
                                </td>
                            @else
                                <td>
                                    <a data-toggle="tooltip" data-original-title="Show result"
                                       class="btn btn-info btn-sm"
                                       href="{{route('do_exams.show_result',$exam->id)}}"><i class="ni ni-fat-add"></i></a>
                                </td>
                            @endif
                        </tr>
                        @php(array_push($arr,$exam->id))
                    @endforeach
                    {{--                    --}}
                    @foreach($all_exams as $all_exam)
                        @php($count = 0 )
                        @for ($i = 0; $i < count($arr); $i++)
                            @if ($all_exam->id == $arr[$i])
                                @php($count++)
                            @endif
                        @endfor
                        @if ($count == 0)
                            <tr>
                                <td>{{$all_exam->id}}</td>
                                <td>{{$all_exam->title}}</td>
                                <td class="next_line">{{$all_exam->duration}}</td>
                                <td class="next_line">{{$all_exam->start_time}}</td>
                                <td class="next_line">{{$all_exam->end_time}}</td>
                                <td class="next_line">Not do</td>
                                <td class="next_line">Null</td>
                                <td class="next_line">Null</td>
                                <td class="next_line">0</td>
                                <td>
                                    <a data-toggle="tooltip"
                                       data-original-title="Can't show! Because you not do this exam!"
                                       class="btn btn-info btn-sm"><i class="ni ni-fat-add"></i></a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
@endsection


@section('script')
    <script type="text/javascript">
        function check() {
            var id_student = '{{auth()->user()->id_student}}';
            if (id_student == "") alert("Please change your Id Student to Join class");
            else document.getElementById('join').click();
        }

        var url = "{{ url('ajax/class') }}";

        function class_info() {
            var code = $("input[name='code']").val();
            var token = $("input[name='_token']").val();
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    code: code,
                    _token: token
                },
                success: function (data) {
                    if (data.length == 1) {
                        $("select[name='class']").html('');
                        $.each(data, function (key, value) {
                            $("select[name='class']").append(
                                "<option value=" + value.id + ">" + value.name + "</option>"
                            );
                        });
                    }
                    if (data.length == 0) {
                        $("select[name='class']").html('');
                        $("select[name='class']").append("<option value='' >" + "-- None --" + "</option>");
                        alert('This code ' + '"' + code + '"' + ' does not exist');
                    }
                }
            });
        };
    </script>
@endsection