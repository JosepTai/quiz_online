<nav class=" sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header d-flex align-items-center">
            <a class="navbar-brand" href="{{route('home')}}">
                <img src="assets/img/brand/blue.png" class="navbar-brand-img" alt="...">
            </a>
            <div class="ml-auto">
                <!-- Sidenav toggler -->
                <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('home')}}" role="button" aria-expanded="true">
                            <i class="ni ni-shop text-primary"></i>
                            <span class="nav-link-text">Dashboards</span>
                        </a>
                    </li>
                    <!-- Modules -->
                    <li class="nav-item">
                        <a class="nav-link " href="#navbar-modules" data-toggle="collapse" role="button"
                           aria-expanded="false" aria-controls="navbar-examples">
                            <i class="ni ni-ungroup text-orange"></i>
                            <span class="nav-link-text">Modules</span>
                        </a>
                        <div class="collapse" id="navbar-modules">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{route('modules.index')}}" class="nav-link">My Modules</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('chapters.index')}}" class="nav-link">Chapters</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('parts.index')}}" class="nav-link">Parts</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- Classes -->
                    <li class="nav-item">
                        <a class="nav-link" href="#navbar-classes" data-toggle="collapse" role="button"
                           aria-expanded="false" aria-controls="navbar-components">
                            <i class="ni ni-ui-04 text-info"></i>
                            <span class="nav-link-text">Classes</span>
                        </a>
                        <div class="collapse" id="navbar-classes">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{route('classes.index')}}" class="nav-link">My classes</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('participated.index')}}" class="nav-link">Participated</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- Questions -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('questions.index')}}" role="button" aria-expanded="true">
                            <i class="ni ni-shop text-primary"></i>
                            <span class="nav-link-text">Questions</span>
                        </a>
                    </li>
                    <!-- Exams -->
                    <li class="nav-item">
                        <a class="nav-link" href="#navbar-exams" data-toggle="collapse" role="button"
                           aria-expanded="false" aria-controls="navbar-components">
                            <i class="ni ni-ui-04 text-info"></i>
                            <span class="nav-link-text">Exams</span>
                        </a>
                        <div class="collapse" id="navbar-exams">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{route('exams.index')}}" class="nav-link">My Exams</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Do Exams</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>