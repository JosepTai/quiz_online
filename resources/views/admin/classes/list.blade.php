@extends('admin.layouts.index')
@section('content')
@if(session('thongbao'))
<div class="alert alert-success">
    {{session('thongbao')}}
</div>
@endif
<div class="row">
    <div class="card col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card-body">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 fix-top">
                <h1 class="page-header">Classes
                <button class="btn btn-outline-success btn-fw">Add New Class</button>
                </h1>
            </div>
            <table id="table" class="table">
               <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Create At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($classes as $class)

                        <tr class="odd gradeX" align="center">
                        <td>{{$class->id}}</td>
                        <td>{{$class->name}}</td>
                        <td>{{$class->created_at}}</td>
                        {{--<td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/class/xoa/{{$tl->id}}"> Delete</a></td>--}}
                        {{--<td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/class/sua/{{$tl->id}}">Edit</a></td>--}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection



