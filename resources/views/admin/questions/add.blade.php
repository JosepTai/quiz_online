@extends('admin.layouts.index')
@section('content')
<div class="row list_table">
    <div class="card col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="card-body">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 fix-top">
                <h1 class="page-header">
                <i class="mdi mdi-comment-question-outline"><b>   Question </b></i>
                <small >Add new question</small></h1>
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
                    <form action="admin/questions/add" method="POST" name="form">
                        <input type="hidden" name="_token" value="{{csrf_token()}}" />
                        <div class="form-group">
                            <label>Question Content</label>
                            <textarea rows="5" class="form-control" name="content" required="required"/></textarea><br>
                            <label> Level</label>
                            <select name="level" class="form_control">
                                <option value="easy">Easy</option>
                                <option value="hard">Hard</option>  
                            </select><br><br>
                            <label>Answer 1</label>
                            <input class="form-control" name="answer_1" required="required"/><br>
                            <label>Answer 2</label>
                            <input class="form-control" name="answer_2" required="required"/><br>
                            <label>Answer 3</label>
                            <input class="form-control" name="answer_3" required="required"/><br>
                            <label>Answer 4</label>
                            <input class="form-control" name="answer_4" required="required"/><br>
                            <label>Correct Answer</label>
                            <input class="form-control" name=" correct_answer" required="required"/>
                        </div>
                        <button type="submit" class="btn btn-inverse-success" onClick=" return checkform(form);">Add</button>
                        <a type= "button" href="admin/questions" class="btn btn-inverse-dark">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection