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
                                <a class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">
                                    Add new Question
                                </a>

                            </h1>
                            {{--                        modal--}}
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
                                            <form action="{{route('questions.create')}}" method="POST" name="form">
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
                                                <label style="float: left">Level</label>
                                                <select class="form-control" name="level" required="required">
                                                    <option value="easy">Easy</option>
                                                    <option value="hard">Hard</option>
                                                </select><br>
                                                <br>

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
                                                    <button type="button" class="btn btn-outline-secondary"
                                                            data-dismiss="modal">Close
                                                    </button>
                                                    <button id="submit" disabled type="submit" class="btn btn-success">
                                                        Add
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
                                <a data-toggle="tooltip" data-original-title="Show" class="btn btn-info btn-sm"
                                   href="#"><i class="ni ni-fat-add"></i></a>
                                <a data-toggle="tooltip" data-original-title="Delete" class="btn btn-danger btn-sm"
                                   href="#"><i class="ni ni-fat-remove"></i></a>
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
        var url1 = "{{ url('ajax/chapters') }}";
        $("select[name='module']").change(function () {
            var module_id = $(this).val();
            var token = $("input[name='_token']").val();
            $.ajax({
                url: url1,
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
                    var url2 = "{{ url('ajax/parts') }}";
                    $("select[name='chapter']").change(function () {
                        var chapter_id = $(this).val();
                        var token = $("input[name='_token']").val();
                        $.ajax({
                            url: url2,
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
                            '</div>';;
                for (var i = 1; i <= x; i++) {
                    html += '' +
                        '<div class="row">' +
                            '<div class="col-md-11">' +
                                '<textarea rows="2" placeholder="Answer ' + i + '" class="form-control" name="answer_' + i + '" required="required"></textarea><br>' +
                            '</div>' +
                            '<div class="col-md-1">' +
                                '<input style="width: 40px;" type="checkbox" name="is_answer[]" value="' + i + '">' +
                            '</div>' +
                        '</div>';
                }
                document.getElementById('input_answer').innerHTML = html;
                document.getElementById('submit').disabled = false;
            }
        }
    </script>
@endsection