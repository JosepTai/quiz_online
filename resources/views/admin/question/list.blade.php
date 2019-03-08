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
                <i class="mdi mdi-comment-question-ouquesine"><b>   Question</b></i>
                
                <button class="btn btn-outline-success btn-fw">Add New Question</button>
                </h1>
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
                    @foreach($question as $ques)
                    <tr class="odd gradeX" align="center">
                        <td>{{$ques->id}}</td>
                        <td>{{$ques->content}}</td>
                        <td>{{$ques->level}}</td>
                        <td>{{$ques->answer_1}}</td>
                        <td>{{$ques->answer_2}}</td>
                        <td>{{$ques->answer_3}}</td>
                        <td>{{$ques->answer_4}}</td>
                        <td>{{$ques->correct_answer}}</td>
                        <td>{{$ques->create_at}}</td>
                        <td class="center action"><a type="button" class="btn btn-outline-danger btn-icon-text" href="admin/question/delete/{{$ques->id}}"><i class="mdi mdi-delete "></i></a></td>
                        <td class="center action"><a type="button" class="btn btn-outline-success btn-icon-text" href="admin/question/edit/{{$ques->id}}"><i class="mdi mdi-grease-pencil "></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection