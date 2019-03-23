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
                <i class="mdi mdi-comment-question-outline"><b>   Module</b></i>
                
                <a type= "button" href="admin/modules/chapters/add" class="btn btn-outline-success">Add New Module</a>
                </h1>
                {{-- modal --}}

            </div>
            <table class="table">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($chapters as $chapter)
                    <tr class="odd gradeX" align="center">
                        <td>{{$chapter->id}}</td>
                        <td>{{$chapter->name}}</td>
                        <td>{{$chapter->created_at}}</td>
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