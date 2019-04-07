@extends('layouts.index')
@section('content')
    <div class="row list_table">
        <div class="card col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 fix-top">
                    <h1 class="page-header">
                        <i class="mdi mdi-comment-question-outline"><b> Question </b></i></h1>
                </div>
                <br>
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
                        <div class="alert alert-success">
                            {{session('message')}}
                        </div>
                    @endif
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <form action="question/edit/{{$question->id}}" method="POST" name="form">
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            <div class="form-group">
                                <label>Question Content</label>
                                <textarea rows="5" class="form-control" name="content"
                                          required="required"/>{{$question->content}}</textarea><br>
                                <label>Answer 1</label>
                                <input class="form-control" name="answer_1" required="required"
                                       value="{{$question->answer_1}}"/><br>
                                <label>Answer 2</label>
                                <input class="form-control" name="answer_2" required="required"
                                       value="{{$question->answer_2}}"/><br>
                                <label>Answer 3</label>
                                <input class="form-control" name="answer_3" required="required"
                                       value="{{$question->answer_3}}"/><br>
                                <label>Answer 4</label>
                                <input class="form-control" name="answer_4" required="required"
                                       value="{{$question->answer_4}}"/><br>
                                <label>Correct Answer</label>
                                <input class="form-control" name=" correct_answer" required="required"
                                       value="{{$question->correct_answer}}"/>
                            </div>
                            <button type="submit" class="btn btn-inverse-success" onClick=" return checkform(form);">
                                Apply
                            </button>
                            <a type="button" href="question" class="btn btn-inverse-dark">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function checkform(form) {
            if (form.correct_answer.value != form.answer_1.value) {
                if (form.correct_answer.value != form.answer_2.value) {
                    if (form.correct_answer.value != form.answer_3.value) {
                        if (form.correct_answer.value != form.answer_4.value) {
                            alert("This Correct Answer is not same!");
                            form.correct_answer.focus();
                        }
                    }
                }
            } else {
                alert("ok");
                window.location.assign("question/edit/{{$question->id}}");
            }
        }
    </script>

@endsection