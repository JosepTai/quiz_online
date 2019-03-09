@extends('admin.layouts.index')
@section('content')
@if(session('thongbao'))
<div class="alert alert-success">
    {{session('thongbao')}}
</div>
@endif
<div class="row list_table">
    <div class="card col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card-body">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 fix-top">
                <h1 class="page-header">
                <i class="mdi mdi-comment-question-outline"><b>   Question</b></i>
                
                <button class="btn btn-outline-success btn-fw" href='#modal-id' data-toggle="modal" >Add New Question</button>
                </h1>
                {{-- modal --}}
                <div class="modal fade" id="modal-id">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title ">Add new Question</h4>
                            </div>
                            <form action="admin/question/" method="POST" class="form-group">
                                <div class="modal-body">
                                    <label>Question Content</label>
                                    <input class="form-control" name="content" required="required" /><br>
                                    <label>Level of difficult</label>
                                    <select name="level" class="form_control">
                                        <option value="easy">Easy</option>
                                        <option value="hard">Hard</option>
                                    </select><br>
                                    <label>Answer 1</label>
                                    <input class="form-control" name="answer_1" required="required" /><br>
                                    <label>Answer 2</label>
                                    <input class="form-control" name="answer_2" required="required" /><br>
                                    <label>Answer 3</label>
                                    <input class="form-control" name="answer_3" required="required" /><br>
                                    <label>Answer 4</label>
                                    <input class="form-control" name="answer_4" required="required" /><br>
                                    <label>Correct Answer</label>
                                    <input class="form-control" name=" correct_answer" required="required"/>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="sunmit" class="btn btn-primary">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Content</th>
                        <th>Level</th>
                        <th>Answer 1</th>
                        <th>Answer 2</th>
                        <th>Answer 3</th>
                        <th>Answer 4</th>
                        <th>Correct Answer</th>
                        <th>Create At</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($question as $question)
                    <tr class="odd gradeX" align="center">
                        <td>{{$question->id}}</td>
                        <td>{{$question->content}}</td>
                        <td>{{$question->level}}</td>
                        <td>{{$question->answer_1}}</td>
                        <td>{{$question->answer_2}}</td>
                        <td>{{$question->answer_3}}</td>
                        <td>{{$question->answer_4}}</td>
                        <td>{{$question->correct_answer}}</td>
                        <td>{{$question->create_at}}</td>
                        <td class="center action"><a type="button" class="btn btn-outline-danger btn-icon-text" href="admin/question/delete/{{$question->id}}"><i class="mdi mdi-delete "></i></a></td>
                        <td class="center action"><a type="button" class="btn btn-outline-success btn-icon-text" href="admin/question/edit/{{$question->id}}"><i class="mdi mdi-grease-pencil "></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection