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
                        <h6 class="h2 text-white d-inline-block mb-0">Chapters</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fas fa-home"></i></a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('modules.index')}}">Modules</a></li>
                                @if (isset($title))
                                    <li class="breadcrumb-item"><a>{{$title->name}}</a></li>
                                @endif
                                <li class="breadcrumb-item active" aria-current="page">Chapters</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 fix-top">
                            <h1 class="page-header">
                                <a class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">
                                    Add new Chapter
                                </a>

                            </h1>
                            {{--                        module--}}
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog " role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Add new Chapter</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('chapters.create')}}" method="POST" name="form">
                                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                                <input placeholder="Name chapter" class="form-control" name="name"
                                                       required="required"/><br>
                                                <label style="float: left">Module</label>
                                                <select class="form-control" name="module" required="required">
                                                    <option value="">-- Choose Module --</option>
                                                    @foreach($modules as $module)
                                                        <option value="{{$module->id}}">{{$module->name}}</option>
                                                    @endforeach
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
                        <th>Module</th>
                        <th>Created_at</th>
                        <th></th>

                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Module</th>
                        <th>Created_at</th>
                        <th></th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($chapters as $chapter)
                        <tr>
                            <td>{{$chapter->id}}</td>
                            <td class="next_line">{{$chapter->name}}</td>
                            <td class="next_line">{{$chapter->module->name}}</td>
                            <td>{{$chapter->updated_at}} </td>
                            <td>
                                <a data-toggle="tooltip" data-original-title="Show" class="btn btn-info btn-sm"
                                   href="{{route('chapters.show',$chapter->id)}}"><i class="ni ni-fat-add"></i></a>
                                <a data-toggle="modal" data-target="#update"
                                   onclick="update('{{$chapter->id}}', '{{$chapter->name}}')" data-original-title="Edit"
                                   class="btn btn-primary btn-sm"><i class="ni ni-settings"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{--            --}}
        <div class="modal fade" id="update" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Update</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('chapters.update')}}" method="POST" name="form">
                            @method('PUT')
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            <input id="name_update" class="form-control" name="name_update"
                                   required="required"/><br>
                            <input hidden id="id_update" class="form-control" name="id_update"
                                   required="required"/><br>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary"
                                        data-dismiss="modal">Close
                                </button>
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{--    --}}

    </div>
    </div>

@endsection
@section('script')
    <script>
        function update(id, name) {
            document.getElementById('name_update').value = name;
            document.getElementById('id_update').value = id;
        }
    </script>
@endsection
