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
                                <li class="breadcrumb-item"><a>Questions</a></li>
                                <li class="breadcrumb-item"><a>Details</a></li>
                                {{--                                <li class="breadcrumb-item active" aria-current="page">Parts</li>--}}
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 fix-top">
                            <h1 class="page-header">
                                <a id="add_question" class="btn btn-success">
                                    Edit this question
                                </a>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div style="width: 70%; margin: auto" class="card mb-4">
            <div class="card-header row">
                <div style="border-right: 1px solid #e5e5e5" class="col-md-7">
                    <h3>Question: {{$question->content}}</h3>
                </div>
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-3">
                            <lable style="border: none" class="form-control">Level</lable>
                        </div>
                        <div class="col-md-4">
                            <select disabled name="" id="" class="form-control">
                                @if ($question->level = "easy")
                                    <option value="easy">easy</option>
                                    <option value="hard">hard</option>
                                @else
                                    <option value="hard">hard</option>
                                    <option value="easy">easy</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <lable style="border: none" class="form-control">Image</lable>
                        </div>
                        <div class="col-md-4">
                            @if ($question->image == null)
                                <p>None image</p>
                            @else
                                <img style="max-width: 300px; max-height: 300px;margin: auto; display: block"
                                     src="{{url('/images/'.$question->image)}}">
                            @endif
                            <br>
                            <div id="show_choose"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div style="text-align: center" class="row">
                    <div class="col-md-11">Answer content</div>
                    <div class="col-md-1">Is correct answer</div>
                </div>
                <br>
                @foreach($answers as $answer)
                    <div class="row">
                        <div class="col-md-11">
                            <input  disabled class="form-control input_answer" type="text" name="answer_{{$answer->id}}" value="{{$answer->content}}">
                        </div>
                        <div class="col-md-1">
                            @if ($answer->is_correct == 1)
                                <input style="margin-left: 30px" class="checkbox_answer" disabled style="margin: auto" checked type="checkbox" name="is_correct_{{$answer->id}}">
                            @else
                                <input style="margin-left: 30px" class="checkbox_answer" disabled style="margin: auto" type="checkbox" name="is_correct_{{$answer->id}}">
                            @endif
                        </div>
                    </div><br>
                @endforeach
            </div>
        </div>
        {{--            --}}

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
            } else if (document.getElementById('image').value.lastIndexOf(".png") > -1 || document.getElementById('image').value.lastIndexOf(".PNG") > -1
                || document.getElementById('image').value.lastIndexOf(".jpg") > -1 || document.getElementById('image').value.lastIndexOf(".JPG") > -1
                || document.getElementById('image').value.lastIndexOf(".jpeg") > -1 || document.getElementById('image').value.lastIndexOf(".JPEG") > -1
                || document.getElementById('image').value.lastIndexOf(".gif") > -1 || document.getElementById('image').value.lastIndexOf(".GIF") > -1
            ) {
                return true;
            } else {
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
    <script>
        var url_show_detail = "{{ url('ajax/show_detail') }}";

        function show_detail(id, content, level) {
            var question_id = id;
            var token = $("input[name='_token']").val();
            $.ajax({
                url: url_show_detail,
                method: 'POST',
                data: {
                    question_id: question_id,
                    _token: token

                },
                success: function (data) {
                    $("div[id='show']").html('');
                    $("div[id='show']").append(
                        "<h3> Question:</h3> <span>" + content + "</span> <br><br>" +
                        "<lable><b>Level:  </b> " + level + "</lable><hr> "
                    );
                    var dem = 1;
                    $.each(data, function (key, value) {
                        $("div[id='show']").append(
                            "<lable class=\"next_line\"> <b>Answer " + dem + " :</b>   " +
                            value.content
                            + "</lable><br><br>"
                        );
                        dem++;
                    });
                }
            });
        };
    </script>
@endsection