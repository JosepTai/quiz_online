<nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom" xmlns="http://www.w3.org/1999/html">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Search form -->
            <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
                <div class="form-group mb-0">

                </div>
                <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main"
                        aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </form>
            <!-- Navbar links -->
            <ul class="navbar-nav align-items-center ml-md-auto">
                <li class="nav-item d-xl-none">
                    <!-- Sidenav toggler -->
                    <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin"
                         data-target="#sidenav-main">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </div>
                </li>
                <li class="nav-item d-sm-none">
                    <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                        <i class="ni ni-zoom-split-in"></i>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav align-items-center ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a onclick="reset_profile()" id="profile" class="dropdown-item" href="" data-toggle="modal"
                           data-target="#navbarModell">Profile</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
            {{----}}
            <div class="modal fade" id="navbarModell" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Change your profile</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="sub_profile" action="{{route('profile')}}" method="POST" name="form"
                                  onsubmit="submit_profile()">
                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                <div class="row">
                                    <div class="col-md-3">
                                        <lable>Name</lable>
                                    </div>
                                    <div class="col-md-9">
                                        <input name="name_profile" class="form-control" type="text"
                                               value="{{auth()->user()->name}}">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-3">
                                        <lable>ID student</lable>
                                    </div>
                                    <div class="col-md-9">
                                        <input name="id_student" class="form-control" type="text"
                                               value="{{auth()->user()->id_student}}" placeholder="Please enter your ID Student" required>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-3">
                                        <lable>Email</lable>
                                    </div>
                                    <div class="col-md-9">
                                        <input id="email_profile" name="email_profile" class="form-control" type="text"
                                               value="{{auth()->user()->email}}">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-3">
                                        <lable>New Password</lable>
                                    </div>
                                    <div class="col-md-9">
                                        <input name="new_password" id="new_password" class="form-control" type="text">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-3">
                                        <lable>Confirm Password</lable>
                                    </div>
                                    <div class="col-md-9">
                                        <input id="confirm_password" class="form-control" type="text">
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary"
                                            data-dismiss="modal">Close
                                    </button>
                                    <button style="color: #ffffff" class="btn btn-success">
                                        Update
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            {{--            --}}
        </div>
    </div>
</nav>
@php
    $email = \App\User::query()->select('email')->get();
    $user_email = auth()->user()->email;
@endphp

@section('script')
    <script>
        function reset_profile() {
            document.getElementById('new_password').value = "";
            document.getElementById('confirm_password').value = "";
        }

        function check_email() {
            var email = document.getElementById('email_profile').value;
            var arrs = @json($email);
            var count = 0;
            if (email == @json($user_email)) {
                return true;
            } else {
                for (i = 0; i < arrs.length; i++) {
                    if (arrs[i].email == email) {
                        return false;
                    }
                }
            }
            return true;
        }

        function submit_profile() {
            if (check_email()) {
                var new_password = document.getElementById('new_password').value;
                var confirm_password = document.getElementById('confirm_password').value;
                if (new_password == confirm_password) {
                    return true;
                } else if (new_password != "" && new_password.length < 6) {
                    alert('Password must be longer 6 character!');
                    return false;
                } else if (new_password != confirm_password) {
                    alert(' Confirm password must be same new password');
                    return false;
                }
            }
            else{
                alert('This email dose exit!');
                return false;
            }
        }

        document.getElementById('sub_profile').onsubmit = submit_profile;
    </script>
@endsection