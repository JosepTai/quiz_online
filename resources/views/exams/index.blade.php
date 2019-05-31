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
                                <li class="breadcrumb-item active" aria-current="page">My Exams</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 fix-top">
                            <h1 class="page-header">
                                <a class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">
                                    Add new Exams
                                </a>

                            </h1>
                            {{--                        modal--}}
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Add new Exams</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('exams.create')}}" method="POST" name="form">
                                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                                <input placeholder="Title Exams" class="form-control"
                                                       name="title"
                                                       required="required"/><br>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label style="float: left">Choose Class</label>
                                                            <select class="form-control" name="class" id="class"
                                                                    required="required">
                                                                <option value="">-- Choose Class --</option>
                                                                @foreach($classes as $class)
                                                                    <option value="{{$class->id}}">{{$class->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label style="float: left" class="form-control-label">Duration</label><br>
                                                            <input name="duration" class="form-control" type="number"
                                                                   value="25"
                                                                   id="example-number-input">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="div_date"
                                                     class="row input-daterange datepicker align-items-center">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label style="float: left" class="form-control-label">Start
                                                                date</label>
                                                            <input id="start" name="start_time" class="form-control "
                                                                   placeholder="Start date"
                                                                   type="text" value="{{now()->format('m/d/Y')}}">

                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label style="float: left" class="form-control-label">End
                                                                date</label>
                                                            <input id="end" name="end_time" class="form-control" placeholder="End date" type="text" value="{{now()->format('m/d/Y')}}">

                                                        </div>
                                                    </div>
                                                </div>
                                                <input hidden disabled id="start_hidden" name="start_time" type="text" >
                                                <input hidden disabled id="end_hidden" name="end_time" type="text" >
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div style="padding-right: 50px;">
                                                            <span>Is Test</span>
                                                            <label onclick="check()"
                                                                   class="custom-toggle custom-toggle-info">
                                                                <input id="is_test" type="checkbox" name="is_test">
                                                                <span class="custom-toggle-slider rounded-circle"
                                                                      data-label-off="No" data-label-on="Yes"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div id="show_time" style="display: none">
                                                            <input name="time" id="time" class="form-control"
                                                                   type="time" value="08:30" id="example-time-input">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary"
                                                            data-dismiss="modal">Close
                                                    </button>
                                                    <button type="submit" class="btn btn-success">Add</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
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
                        <th>Id</th>
                        <th>Title</th>
                        <th>Class</th>
                        <th>Duration</th>
                        <th>Status</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Create At</th>
                        <th></th>

                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Class</th>
                        <th>Duration</th>
                        <th>Status</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Create At</th>
                        <th></th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($exams as $exam)
                        <tr>
                            <td>{{$exam->id}}</td>
                            <td class="next_line">{{$exam->title}}</td>
                            <td class="next_line">{{$exam->belongsToclass->name}}</td>
                            <td class="next_line">{{$exam->duration}} minutes</td>
                            <td class="next_line">{{$exam->status}}</td>
                            <td class="next_line">{{$exam->start_time}}</td>
                            <td class="next_line">{{$exam->end_time}}</td>
                            <td class="next_line">{{$exam->updated_at}}</td>
                            <td>
                                <a class="btn btn-info btn-sm"
                                   href="{{route('exams.show',$exam->id)}}">Show</a>
                                @if ($exam->status == "close")
                                    <a style="color: #fff" class="btn btn-default btn-sm"
                                       href="{{route('configs.index',$exam->id)}}">Config</a>
                                @else
                                    <a style="color: #fff" disabled="disabled" class="btn btn-default btn-sm"
                                    >Configed</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

@endsection

{{--Ajax load chapter when choose module--}}
@section('script')
    <script type="text/javascript">
        function check() {
            var checkBox = document.getElementById('is_test');
            var show_time = document.getElementById('show_time');
            var start = document.getElementById('start');
            var end = document.getElementById('end');
            if (checkBox.checked == true) {
                show_time.style.display = "block";
                end.value = start.value;
                end.disabled = true;
                start.disabled = true;
                document.getElementById('start_hidden').disabled = false;
                document.getElementById('start_hidden').value = start.value;
                document.getElementById('end_hidden').disabled=false;
                document.getElementById('end_hidden').value = start.value;
            } else {
                show_time.style.display = "none";
                end.disabled = false;
                start.disabled = false;
                document.getElementById('start_hidden').disabled=true;
                document.getElementById('end_hidden').disabled=true;

            }
        }
    </script>
@endsection