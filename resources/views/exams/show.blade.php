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
                        <h6 class="h2 text-white d-inline-block mb-0">Exams</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{route('exams.index')}}">Exams</a></li>
                                <li class="breadcrumb-item active" aria-current="page">My Exams</li>
                                <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
                            </ol>
                        </nav>
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Start time</th>
                        <th>End time</th>
                        <th>Score</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Start time</th>
                        <th>End time</th>
                        <th>Score</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            @php($count=0)
                            @foreach($infors as $infor)
                                @if ($infor['user_id'] == $user->id)
                                    @if($infor['end_time'] > now())
                                        <td>Doing</td>
                                        <td>{{$infor['start_time']}}</td>
                                        <td>{{$infor['end_time']}}</td>
                                        <td>0</td>
                                    @else
                                        @if ($infor['start_time'] == $infor['end_time'] )
                                            <td>Not do</td>
                                        @else
                                            <td>Complete</td>
                                        @endif
                                        <td>{{$infor['start_time']}}</td>
                                        <td>{{$infor['end_time']}}</td>
                                        <td>{{$infor['score']}}</td>
                                    @endif
                                    @php($count++)
                                @endif
                            @endforeach
                            @if ($count == 0)
                                <td>Not do</td>
                                <td></td>
                                <td></td>
                                <td>0</td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

@endsection