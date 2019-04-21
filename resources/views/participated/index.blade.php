@extends('layouts.index')
@section('content')
    @if(session('message'))
        <div class="alert alert-success" id="message">
            {{session('message')}}
        </div>
    @endif
    @if(session('err'))
        <div class="alert alert-danger" id="err">
            {{session('err')}}
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
                                <li class="breadcrumb-item"><a href="{{route('classes.index')}}">Classes</a></li>
                                <li class="breadcrumb-item"><a>Participated</a></li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 fix-top">
                            <h1 class="page-header">
                                <a class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">
                                    Join Class
                                </a>
                            </h1>
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog " role="document">
                                    <div class="card-pricing bg-gradient-success border-0 text-center mb-4 modal-content">
                                        <div class="card-header bg-transparent">
                                            <h4 class="text-uppercase ls-1 text-white py-3 mb-0">Enter code to join
                                                class</h4>
                                        </div>
                                        <div class="model-body">
                                            <div class="card-body px-lg-11">
                                                <form action="{{route('participated.join')}}" method="POST" name="form">
                                                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                                    <div class="form-row">
                                                        <div class="col-9">
                                                            <input type="text" class="form-control"
                                                                   placeholder="Enter your code" name="code"
                                                                   required="required">
                                                        </div>
                                                        <div class="col-2">
                                                            <a onclick="class_info()" class=" btn btn-info text-white">Check</a>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <select class="form-control" name="class" id="class"
                                                            required="required">
                                                        <option value=""> -- None --</option>
                                                    </select>
                                                    <div class="card-footer bg-transparent">
                                                        <button type="submit" class="btn btn-success">Join</button>
                                                    </div>
                                                </form>
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
                        <th>Teacher</th>
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
                    @foreach($classes as $class)
                        <tr>
                            <td>{{$class->id}}</td>
                            <td class="next_line">{{$class->name}}</td>
                            <td class="next_line">{{$class->teacher->name}}</td>
                            <td>{{$class->pivot->updated_at}} </td>
                            <td>
                                <a data-toggle="tooltip" data-original-title="Show" class="btn btn-info btn-sm"
                                   href="#"><i class="ni ni-fat-add"></i></a>
                                <a data-toggle="tooltip" data-original-title="Leave this class"
                                   class="btn btn-danger btn-sm" href="{{route('participated.leave',$class->id)}}"><i
                                            class="ni ni-fat-remove"></i></a>
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


@section('script')
    <script type="text/javascript">
        var url = "{{ url('ajax/class') }}";

        function class_info() {
            var code = $("input[name='code']").val();
            var token = $("input[name='_token']").val();
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    code: code,
                    _token: token
                },
                success: function (data) {
                    if (data.length == 1) {
                        $("select[name='class']").html('');
                        $.each(data, function (key, value) {
                            $("select[name='class']").append(
                                "<option value=" + value.id + ">" + value.name + "</option>"
                            );
                        });
                    }
                    if (data.length == 0) {
                        $("select[name='class']").html('');
                        $("select[name='class']").append("<option value='' >" + "-- None --" + "</option>");
                        alert('This code ' + '"' + code + '"' + ' does not exist');
                    }
                }
            });
        };
    </script>
@endsection