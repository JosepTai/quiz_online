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
                        <h6 class="h2 text-white d-inline-block mb-0">Classes</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#">Classes</a></li>
                                <li class="breadcrumb-item"><a href="#">{{$classes->name}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Students</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 fix-top">
                            <h1 class="page-header">
                                <a class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">
                                    Show Code
                                </a>

                            </h1>
                            {{--                        module--}}
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog " role="document">
                                    <div class="card-pricing bg-gradient-success border-0 text-center mb-4 modal-content">
                                        <div class="card-header bg-transparent">
                                            <h4 class="text-uppercase ls-1 text-white py-3 mb-0">Share this code for
                                                students to join this
                                                class</h4>
                                        </div>
                                        <div class="card-body px-lg-7">
                                            <div class="display-2 text-white"><label
                                                        id="code">{{$classes->code}}</label></div>
                                        </div>
                                        <div class="card-footer bg-transparent">
                                            <button onclick="copy()" class=" btn btn-outline-success text-white">Click
                                                to copy this code
                                            </button>
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
                        <th>Name</th>
                        <th>Module</th>
                        <th>Joined At</th>
                        <th></th>

                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Joined At</th>
                        <th></th>
                    </tr>
                    </tfoot>
                    <tbody>

                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td class="next_line">{{$user->name}}</td>
                            <td class="next_line">{{$user->email}}</td>
                            <td>{{$user->pivot->updated_at}} </td>
                            <td>
                                <a data-toggle="tooltip" data-original-title="Show" class="btn btn-info btn-sm"
                                   href="#"><i class="ni ni-fat-add"></i></a>
                                <a data-toggle="tooltip" data-original-title="Delete" class="btn btn-danger btn-sm"
                                   href="classes"><i class="ni ni-fat-remove"></i></a>
                                <a data-toggle="tooltip" data-original-title="Edit" class="btn btn-primary btn-sm"
                                   href="classes"><i class="ni ni-settings"></i></a>
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
