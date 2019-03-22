@extends('admin.layouts.index')
@section('content')
@if(session('message'))
<div class="alert alert-success" id="message">
    {{session('message')}}
</div>
@endif
<div class="row list_table">
    <div class="card col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card-body">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 fix-top">
                <h1 class="page-header">
                <i class="mdi mdi-comment-question-outline"><b>   Question</b></i>
                
                <a type= "button" href="admin/question/add" class="btn btn-outline-success">Add New Question</a>
                </h1>
                {{-- modal --}}

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
                    </tr>
                </thead>
                <tbody>
                    @foreach($questions as $questions)
                    <tr class="odd gradeX" align="center">
                        <td>{{$questions->id}}</td>
                        <td>{{$questions->content}}</td>
                        <td>{{$questions->level}}</td>
                        <td>{{$questions->answer_1}}</td>
                        <td>{{$questions->answer_2}}</td>
                        <td>{{$questions->answer_3}}</td>
                        <td>{{$questions->answer_4}}</td>
                        <td>{{$questions->correct_answer}}</td>
                        <td>{{$questions->create_at}}</td>
                        {{--<td class="center action"><a type="button" class="btn btn-outline-danger btn-icon-text" href="admin/question/delete/{{$questions->id}}"><i class="mdi mdi-delete "></i></a></td>--}}
                        {{--<td class="center action"><a type="button" class="btn btn-outline-success btn-icon-text" href="admin/question/edit/{{$questions->id}}"><i class="mdi mdi-grease-pencil "></i></a></td>--}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection