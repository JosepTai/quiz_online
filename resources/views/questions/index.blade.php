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
                        <h6 class="h2 text-white d-inline-block mb-0">Questions</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                @if (isset($title))
                                    <li class="breadcrumb-item"><a href="{{route('modules.index')}}">Parts</a></li>
                                    <li class="breadcrumb-item"><a>{{$title->name}}</a></li>
                                @endif
                                <li class="breadcrumb-item"><a>Questions</a></li>
                                {{--                                <li class="breadcrumb-item active" aria-current="page">Parts</li>--}}
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 fix-top">
                            <h1 class="page-header">
                                <a id="add_question" class="btn btn-success" data-toggle="modal"
                                   data-target="#exampleModalCenter">
                                    Add new Question
                                </a>

                                <a class="btn btn-success" data-toggle="modal" data-target="#import">
                                    Import Questions
                                </a>
                            </h1>
                            {{--                        modal new question--}}
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Add new Question</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('questions.create')}}" method="POST" name="form"
                                                  onsubmit="return check_add(false)" enctype="multipart/form-data">
                                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                                <div class="form-row">
                                                    <div class="col-md-4 mb-3">
                                                        <label style="float: left">Module</label>
                                                        <select class="form-control" name="module" id="module"
                                                                required="required">
                                                            <option value="">-- Choose Module --</option>
                                                            @foreach($modules as $module)
                                                                <option value="{{$module->id}}">{{$module->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label style="float: left">Chapter</label>
                                                        <select class="form-control" name="chapter" id="chapter"
                                                                required="required">
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label style="float: left">Part</label>
                                                        <select class="form-control" name="part" id="part"
                                                                required="required">
                                                        </select>
                                                    </div>
                                                </div>
                                                {{--                                                --}}
                                                <label style="float: left">Content</label><br>
                                                <textarea rows="3" placeholder="content" class="form-control"
                                                          name="content" required="required"></textarea><br>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label style="float: left">Level</label>
                                                        <select class="form-control" name="level" required="required">
                                                            <option value="easy">Easy</option>
                                                            <option value="hard">Hard</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label style="float: left">Image
                                                            <small>(Size image small than 5Mb)</small>
                                                        </label>
                                                        <input id="image" type="file" name="image" class="form-control">
                                                    </div>
                                                </div>
                                                <br><br>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <lable style="padding-top: 10px;float: left">Amount Answers
                                                        </lable>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input name="amount" class="form-control" type="number" min="2"
                                                               max="9"
                                                               id="amount" value="2">
                                                    </div>
                                                    <div class="col-md-1">
                                                        <a class="btn-outline-success btn" id="add"
                                                           onclick="add_answer()">Add
                                                        </a>
                                                    </div>
                                                </div>
                                                <br>
                                                <div id="input_answer"></div>
                                                <div class="modal-footer">
                                                    <button id="close" type="button" class="btn btn-outline-secondary"
                                                            data-dismiss="modal">Close
                                                    </button>
                                                    <button id="sub" disabled type="submit" class="btn btn-success">
                                                        Add
                                                    </button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            {{--                           modal import --}}
                            <div class="modal fade" id="import" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="import">Import Question</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('questions.import')}}" method="POST"
                                                  enctype="multipart/form-data">
                                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                                <div class="form-row">
                                                    <div class="col-md-4 mb-3">
                                                        <label style="float: left">Module</label>
                                                        <select class="form-control" name="module" id="module"
                                                                required="required">
                                                            <option value="">-- Choose Module --</option>
                                                            @foreach($modules as $module)
                                                                <option value="{{$module->id}}">{{$module->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label style="float: left">Chapter</label>
                                                        <select class="form-control" name="chapter" id="chapter"
                                                                required="required">
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label style="float: left">Part</label>
                                                        <select class="form-control" name="part" id="part"
                                                                required="required">
                                                        </select>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <input type="file" name="file" class="form-control" required="required">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <a href="{{asset('storage/Sample Import.xlsx')}}" class="btn btn-outline-success">Download the sample file</a>
                                                    </div>
                                                </div>
                                                {{--                                                --}}
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary"
                                                            data-dismiss="modal">Close
                                                    </button>
                                                    <button type="submit" class="btn btn-success">
                                                        Import
                                                    </button>
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
                        <th>Content</th>
                        <th>Dificulty</th>
                        <th>Part</th>
                        <th>Chapter</th>
                        <th>Module</th>
                        <th>Created At</th>
                        <th></th>

                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Content</th>
                        <th>Dificulty</th>
                        <th>Part</th>
                        <th>Chapter</th>
                        <th>Module</th>
                        <th>Created At</th>
                        <th></th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($questions as $question)
                        <tr>
                            <td>{{$question->id}}</td>
                            <td class="next_line">{{$question->content}}</td>
                            <td>{{$question->level}}</td>
                            <td class="next_line">{{$question->part->name}}</td>
                            <td class="next_line">{{$question->part->chapter->name}}</td>
                            <td class="next_line">{{$question->part->chapter->module->name}}</td>
                            <td>{{$question->updated_at}} </td>
                            <td>
                                <a style="color: #fff" href="{{route('questions.show',$question->id)}}"
{{--                                   onclick="show_detail('{{$question->id}}','{{$question->content}}','{{$question->level}}')"--}}
                                   class="btn btn-info btn-sm"
                                >Show</a>
                                <a style="color: #fff" onclick="check_delete('{{$question->id}}')"
                                   id="delete_{{$question->id}}" class="btn btn-danger btn-sm"
                                >Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{--     show detail       --}}
{{--        <div class="modal fade" id="show_detail" tabindex="-1" role="dialog"--}}
{{--             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">--}}
{{--            <div class="modal-dialog modal-lg" role="document">--}}
{{--                <div class="modal-content">--}}
{{--                    <div class="modal-header">--}}
{{--                        <h2 class="modal-title" id="exampleModalLongTitle">Detail</h2>--}}
{{--                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                            <span aria-hidden="true">&times;</span>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                    <div class="modal-body">--}}
{{--                        <div id="show">--}}

{{--                        </div>--}}
{{--                        <button style="float:right;" type="button" class="btn btn-outline-primary"--}}
{{--                                data-dismiss="modal">Close--}}
{{--                        </button>--}}
{{--                        </form>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

    </div>
    {{--    --}}
    </div>
    </div>


@endsection


@section('script')
    {{--  Check add new question  --}}
    <script>
        function check_add() {
             if ((document.getElementById('image').files[0].size / 1024 / 1024) > 5) {
                document.getElementById('close').click();
                Swal.fire({
                    title: 'Warning!',
                    text: 'File size must be less than 5Mb',
                    type: 'warning',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        document.getElementById('add_question').click();
                    }
                })
                return false;
            }
            else if (document.getElementById('image').value.lastIndexOf(".png") > -1 || document.getElementById('image').value.lastIndexOf(".PNG") > -1
                || document.getElementById('image').value.lastIndexOf(".jpg") > -1 || document.getElementById('image').value.lastIndexOf(".JPG") > -1
                || document.getElementById('image').value.lastIndexOf(".jpeg") > -1 || document.getElementById('image').value.lastIndexOf(".JPEG") > -1
                || document.getElementById('image').value.lastIndexOf(".gif") > -1 || document.getElementById('image').value.lastIndexOf(".GIF") > -1
            ){
                return true;
            }
            else {
                document.getElementById('close').click();
                Swal.fire({
                    title: 'Warning!',
                    text: 'The file must be formatted for image (.png,.jpg,.jpeg,.gif)',
                    type: 'warning',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        document.getElementById('add_question').click();
                    }
                })
                return false;
            }
        }
    </script>
    {{--Ajax load chapter when choose module--}}
    <script type="text/javascript">
        var url_chapter = "{{ url('ajax/chapters') }}";
        $("select[name='module']").change(function () {
            var module_id = $(this).val();
            var token = $("input[name='_token']").val();
            $.ajax({
                url: url_chapter,
                method: 'POST',
                data: {
                    module_id: module_id,
                    _token: token
                },
                success: function (data) {
                    $("select[name='chapter']").html('');
                    $("select[name='part']").html('');
                    $("select[name='chapter']").append(
                        "<option >-- Choose Chapter --</option>"
                    );
                    $.each(data, function (key, value) {
                        $("select[name='chapter']").append(
                            "<option value=" + value.id + ">" + value.name + "</option>"
                        );
                    });
                    //
                    var url_part = "{{ url('ajax/parts') }}";
                    $("select[name='chapter']").change(function () {
                        var chapter_id = $(this).val();
                        var token = $("input[name='_token']").val();
                        $.ajax({
                            url: url_part,
                            method: 'POST',
                            data: {
                                chapter_id: chapter_id,
                                _token: token
                            },
                            success: function (data) {
                                $("select[name='part']").html('');
                                $("select[name='part']").append(
                                    "<option >-- Choose Parts --</option>"
                                );
                                $.each(data, function (key, value) {
                                    $("select[name='part']").append(
                                        "<option value=" + value.id + ">" + value.name + "</option>"
                                    );
                                });
                            }
                        });
                    });
                }
            });
        });
    </script>
    {{--    / add many answer--}}
    <script type="text/javascript">
        function add_answer() {
            var x = document.getElementById("amount").value;
            x = parseInt(x);
            if (x < 2 || x > 10)
                alert('Amount answer must between 2 and 10');
            else {
                var html = '<div style="text-align: center" class="row">' +
                    '<div class="col-md-11">' +
                    '<lable>Answer Content</lable>' +
                    '</div>' +
                    '<div class="col-md-1">' +
                    '<lable>True</lable>' +
                    '</div>' +
                    '</div>';
                ;
                for (var i = 1; i <= x; i++) {
                    html += '' +
                        '<div class="row">' +
                        '<div class="col-md-11">' +
                        '<textarea rows="2" placeholder="Answer ' + i + '" class="form-control" name="answer_' + i + '" required="required"></textarea><br>' +
                        '</div>' +
                        '<div class="col-md-1">' +
                        '<input style="width: 40px;"  type="checkbox" name="is_answer[]" value="' + i + '">' +
                        '</div>' +
                        '</div>';
                }
                document.getElementById('input_answer').innerHTML = html;
                document.getElementById('sub').disabled = false;
            }
        }
    </script>
    {{--    check question exit in config_question--}}
    <script>
        var url_check = "{{ url('ajax/check_question') }}";

        function check_delete(id) {
            var can_delete = 1;
            var token = $("input[name='_token']").val();
            $.ajax({
                url: url_check,
                method: 'POST',
                data: {
                    question_id: id,
                    _token: token
                },
                success: function (data) {
                    if (data > 0) {
                        can_delete = 0;
                        Swal.fire({
                            title: 'Warning!',
                            text: 'This question is exit in exam!',
                            type: 'warning',
                            confirmButtonText: 'OK'
                        })
                    } else {
                        Swal.fire({
                            title: 'Are you want to delete this question?',
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                            if (result.value) {
                                let timerInterval
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                                setTimeout(function () {
                                    window.location = "{{url('questions/')}}/" + id + "/destroy";
                                }, 1000);
                            }
                        })
                    }
                    ;
                }
            });
        };
    </script>
    {{--    show detail question--}}
{{--    <script>--}}
{{--        var url_show_detail = "{{ url('ajax/show_detail') }}";--}}

{{--        function show_detail(id, content, level) {--}}
{{--            var question_id = id;--}}
{{--            var token = $("input[name='_token']").val();--}}
{{--            $.ajax({--}}
{{--                url: url_show_detail,--}}
{{--                method: 'POST',--}}
{{--                data: {--}}
{{--                    question_id: question_id,--}}
{{--                    _token: token--}}

{{--                },--}}
{{--                success: function (data) {--}}
{{--                    $("div[id='show']").html('');--}}
{{--                    $("div[id='show']").append(--}}
{{--                        "<h3> Question:</h3> <span>" + content + "</span> <br><br>" +--}}
{{--                        "<lable><b>Level:  </b> " + level + "</lable><hr> "--}}
{{--                    );--}}
{{--                    var dem = 1;--}}
{{--                    $.each(data, function (key, value) {--}}
{{--                        $("div[id='show']").append(--}}
{{--                            "<lable class=\"next_line\"> <b>Answer " + dem + " :</b>   " +--}}
{{--                            value.content--}}
{{--                            + "</lable><br><br>"--}}
{{--                        );--}}
{{--                        dem++;--}}
{{--                    });--}}
{{--                }--}}
{{--            });--}}
{{--        };--}}
{{--    </script>--}}
@endsection