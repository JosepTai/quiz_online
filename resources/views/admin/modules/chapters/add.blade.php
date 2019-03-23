@extends('admin.layouts.index')
@section('content')
<div class="row list_table">
    <div class="card col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card-body">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 fix-top">
                <h1 class="page-header">
                <i class="mdi mdi-comment-question-outline"><b>   Modules </b></i>
                <small >Add new modules</small></h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                @if(count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $err)
                    {{$err}}<br>
                    @endforeach
                </div>
                @endif
                @if(session('message'))
                <div class="alert alert-success" id="message" style="z-index: 1000;">
                    {{session('message')}}
                </div>
                @endif
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <form action="admin/modules/add" method="POST" name="form">
                        <input type="hidden" name="_token" value="{{csrf_token()}}" />
                            <label>Name Module</label>
                            <input class="form-control" name="name" required="required"/><br>
                        <button type="submit" class="btn btn-inverse-success">Add</button>
                        <a type= "button" href="admin/modules" class="btn btn-inverse-dark">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection