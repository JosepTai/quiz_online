@extends('layouts.index')
@section('content')
    <div class="header pb-6">
        <div class="container-fluid">
        </div>
    </div>
{{--    main--}}<br>
    <div class="container-fluid mt--6">
        <div class="card">
            <div class="row card-body">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-gradient-primary border-0">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0 text-white">Modules</h5>
                                    <span class="h2 font-weight-bold mb-0 text-white">{{$modules}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-white text-white rounded-circle shadow">
                                        <i class="ni ni-ungroup text-orange"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-sm">
                                <a href="#!" class="text-nowrap text-white font-weight-600">See details</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-gradient-info border-0">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0 text-white">Classes</h5>
                                    <span class="h2 font-weight-bold mb-0 text-white">{{$classes}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-white text-white rounded-circle shadow">
                                        <i class="ni ni-ui-04 text-info"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-sm">
                                <a href="#!" class="text-nowrap text-white font-weight-600">See details</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-gradient-danger border-0">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0 text-white">Questions</h5>
                                    <span class="h2 font-weight-bold mb-0 text-white">{{$questions}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-white text-white rounded-circle shadow">
                                        <i style="color: orange" class="ni ni-hat-3"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-sm">
                                <a href="#!" class="text-nowrap text-white font-weight-600">See details</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-gradient-default border-0">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0 text-white">Exams</h5>
                                    <span class="h2 font-weight-bold mb-0 text-white">{{$exams}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-white text-white rounded-circle shadow">
                                        <i style="color: red" class="ni ni-paper-diploma"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-sm">
                                <a href="#!" class="text-nowrap text-white font-weight-600">See details</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection