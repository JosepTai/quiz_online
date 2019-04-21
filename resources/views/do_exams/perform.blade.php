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
                                <li class="breadcrumb-item active" aria-current="page">Perform</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row justify-content-center">
            <div class="col-lg-8 card-wrapper">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">Notifications</h3>
                    </div>
                    <div class="card-body">
                        <button class="btn btn-default" data-toggle="notify" data-placement="top" data-align="center" data-type="default" data-icon="ni ni-bell-55">Default</button>
                        <button class="btn btn-info" data-toggle="notify" data-placement="top" data-align="center" data-type="info" data-icon="ni ni-bell-55">Info</button>
                        <button class="btn btn-success" data-toggle="notify" data-placement="top" data-align="center" data-type="success" data-icon="ni ni-bell-55">Success</button>
                        <button class="btn btn-warning" data-toggle="notify" data-placement="top" data-align="center" data-type="warning" data-icon="ni ni-bell-55">Warning</button>
                        <button class="btn btn-danger" data-toggle="notify" data-placement="top" data-align="center" data-type="danger" data-icon="ni ni-bell-55">Danger</button>
                    </div>
                </div>
                <!-- Sweet alerts -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">Sweet alerts</h3>
                    </div>
                    <div class="card-body">
                        <button class="btn btn-primary" data-toggle="sweet-alert" data-sweet-alert="basic">Basic alert</button>
                        <button class="btn btn-info" data-toggle="sweet-alert" data-sweet-alert="info">Info alert</button>
                        <button class="btn btn-success" data-toggle="sweet-alert" data-sweet-alert="success">Success alert</button>
                        <button class="btn btn-warning" data-toggle="sweet-alert" data-sweet-alert="warning">Warning alert</button>
                        <button class="btn btn-default" data-toggle="sweet-alert" data-sweet-alert="question">Question</button>
                        <button class="btn btn-default" data-toggle="sweet-alert" data-sweet-alert="timer">abc</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--    --}}
    </div>
@endsection

{{--Ajax load chapter when choose module--}}
@section('script')
    <script type="text/javascript">
        var url = "{{ url('ajax/parts') }}";
        console.log(url);
        $("select[name='module']").change(function () {
            var module_id = $(this).val();
            var token = $("input[name='_token']").val();
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    module_id: module_id,
                    _token: token
                },
                success: function (data) {
                    $("select[name='chapter']").html('');
                    $.each(data, function (key, value) {
                        $("select[name='chapter']").append(
                            "<option value=" + value.id + ">" + value.name + "</option>"
                        );
                    });
                }
            });
        });
    </script>
@endsection