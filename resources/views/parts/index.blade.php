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
                        <h6 class="h2 text-white d-inline-block mb-0">Parts</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#">Modules</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Parts</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 fix-top">
                            <h1 class="page-header">
                                <a class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">
                                    Add new Part
                                </a>

                            </h1>
                            {{--                        modal--}}
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog " role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Add new Parts</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('parts.create')}}" method="POST" name="form">
                                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                                <input placeholder="Name chapter" class="form-control" name="name"
                                                       required="required"/><br>
                                                <label style="float: left">Module</label>
                                                <select class="form-control" name="module" id="module"
                                                        required="required">
                                                    <option value="">-- Choose Module --</option>
                                                    @foreach($modules as $module)
                                                        <option value="{{$module->id}}">{{$module->name}}</option>
                                                    @endforeach
                                                </select><br>
                                                <label style="float: left">Chapter</label>
                                                <select class="form-control" name="chapter" id="chapter"
                                                        required="required">
                                                </select>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary"
                                                            data-dismiss="modal">Close
                                                    </button>
                                                    <button type="submit" class="btn btn-success">Add</button>
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
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="card mb-4">
            <div class="table-responsive py-4">
                <table class="table table-flush" id="datatable-basic">
                    <thead class="thead-light">
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Chapters</th>
                        <th>Module</th>
                        <th>Created_at</th>
                        <th></th>

                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Chapter</th>
                        <th>Module</th>
                        <th>Created_at</th>
                        <th></th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($parts as $part)
                        <tr>
                            <td>{{$part->id}}</td>
                            <td class="next_line">{{$part->name}}</td>
                            <td class="next_line">{{$part->chapter_name}}</td>
                            <td class="next_line">{{$part->module_name}}</td>
                            <td>{{$part->updated_at}} </td>
                            <td>
                                <a data-toggle="tooltip" data-original-title="Show" class="btn btn-info btn-sm"
                                   href="{{route('parts.show',$part->id)}}"><i class="ni ni-fat-add"></i></a>
                                <a data-toggle="tooltip" data-original-title="Delete" class="btn btn-danger btn-sm"
                                   href="modules"><i class="ni ni-fat-remove"></i></a>
                                <a data-toggle="tooltip" data-original-title="Edit" class="btn btn-primary btn-sm"
                                   href="modules"><i class="ni ni-settings"></i></a>
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