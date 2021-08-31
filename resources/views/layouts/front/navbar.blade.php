<!--Navbar-->
{{-- <a id="top" role="button" class="p-2"><i class="fas fa-arrow-alt-circle-up fa-2x txtcolor"></i></a> --}}
<a id="top" role="button" class="top_btn gcolor rounded-circle text-center"><i class="fas fa-angle-up fa-2x pt-1"></i></a>

<nav class="navbar navbar-expand-lg navbar-dark unique-color-dark container-fluid fixed-top scrolling-navbar px-lg-5 px-md-5 px-sm-0 px-xs-0">
    {{-- <div class="corner-ribbon top-left sticky turquoise shadow text-uppercase font-weight-bold text-dark">Beta 0.1</div> --}}

    <a class="navbar-brand py-0" href="@auth {{route('user.home')}} @else {{route('home')}} @endauth">
        <img src="{{asset('images/logo.png')}}" height="35" alt="Oplly logo">
        {{-- <p class="mb-0 h2 logo">{{ config('app.name') }}</p> --}}
    </a>
    <!-- Collapse button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
        aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Collapsible content -->
    <div class="collapse navbar-collapse" id="basicExampleNav">

        <!-- Links -->
        <ul class="navbar-nav mr-auto text-uppercase font-weight-normal">
            <li class="nav-item">
                {{-- <a class="nav-link" href="@auth {{route('user.home')}} @else {{route('home')}} @endauth">Home</a> --}}
            </li>
        </ul>
        <!-- Links -->

        {{-- <a class="navbar-brand d-none d-lg-block ml-auto mr-5 py-0 pr-5" href="@auth {{route('user.home')}} @else {{route('home')}} @endauth"><img src="{{asset('images/logo.png')}}" height="35" alt="Oplly logo"></a> --}}

        <ul class="navbar-nav ml-auto nav-flex-icons">
            <!-- Search bar -->
            {{-- <div class="input-group my-auto">
                <input type="text" class="form-control rounded-pill border border-0 mr-n5" size="23" id="search" aria-label="Search" aria-describedby="search">
                <div class="input-group-append">
                    <button class="input-group-text white rounded-pill ml-2 pl-5" type="button" id="search-btn"><i class="fa fa-search text-dark"></i></button>
                </div>
            </div> --}}
            <form class="form-inline mr-2">
                <input class="form-control form-control-sm rounded-pill mr-n4 py-3 pl-3" type="text" size="32" id="search" aria-label="Search" aria-describedby="search">
                <button class="btn btn-link btn-lg p-0 m-0" type="submit"><i class="fas fa-search text-dark"></i></button>
            </form>
            <!-- Search bar -->
            @guest
                <li class="nav-item">
                    <a class="nav-link text-capitalize" href="{{ route('login') }}"><b>Login</b></a>
                </li>
            @else
                @auth
                    {{-- @if (auth()->user()->status == 1)
                        @if (auth()->user()->type > 0)
                            <li class="nav-item dropdown ml-1">
                                <a class="nav-link d-flex justify-content-start" id="navbarDropdownMenuLink-875" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-bell mr-n2"></i>
                                    <sup><span class="badge badge-danger">{{array_sum([$userNotifications->count(), $talentNotifications->count()])}}</span></sup>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right special-color rounded-lg mt-3 mt-3 p-0" aria-labelledby="navbarDropdownMenuLink-875">
                                    <div class="card special-color" style="width:23rem;height:25rem;">
                                        <div class="card-header d-flex justify-content-between align-items-center py-1">
                                            <span><p class="h5 text-white mb-0">Notifications</p></span>
                                            <span>
                                                <a role="button" class="btn-link text-white pb-0"><p class="mb-0">mark as read</p></a>
                                                <a role="button" class="btn-link text-white pb-0 pr-0"><p class="mb-0">clear all</p></a>
                                            </span>
                                        </div>
                                        <div class="card-body py-0 overflow-auto">
                                            @foreach ($userNotifications as $data)
                                                <a href="{{route('user.videos')}}" class="dropdown-item d-flex justify-content-between align-items-center bg-light text-dark rounded-pill p-0 my-2">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <img src="{{($data->tavatar) ? asset('storage/content/avatar/' . $data->tavatar) : asset('images/avatar.png')}}"
                                                            class="rounded-circle z-depth-1 img-fluid" width="50" height="50">
                                                        <div class="ml-4">
                                                            <div><small class="my-0 p-0"><b>{{$data->tname}}</b></small></div>
                                                            <div><small class="my-0 p-0"><b>{{$data->reqoccasion}}</b></small></div>
                                                        </div>
                                                    </div>
                                                    @if ($data->reqstatus == 'Submitted')
                                                        <span class="badge badge-success rounded-pill p-3 mr-1"><p class="mb-0 text-dark">{{$data->reqstatus}}</p></span>
                                                    @elseif ($data->reqstatus == 'Rejected')
                                                        <span class="badge badge-danger rounded-pill p-3 mr-1"><p class="mb-0 text-dark">{{$data->reqstatus}}</p></span>
                                                    @endif
                                                </a>
                                            @endforeach
                                            @foreach ($talentNotifications as $data)
                                                <a href="{{route('user.notification')}}" class="dropdown-item d-flex justify-content-between align-items-center bg-light text-dark rounded-pill p-0 my-2">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <img src="{{($data->uavatar) ? asset('storage/content/avatar/' . $data->uavatar) : asset('images/avatar.png')}}"
                                                            class="rounded-circle z-depth-1 img-fluid" width="50" height="50">
                                                        <div class="ml-4">
                                                            <div><small class="my-0 p-0"><b>{{$data->uname}}</b></small></div>
                                                            <div><small class="my-0 p-0"><b>{{$data->reqoccasion}}</b></small></div>
                                                        </div>
                                                    </div>
                                                    <span class="badge badge-warning rounded-pill p-3 mr-1"><p class="mb-0 text-dark">{{$data->reqstatus}}</p></span>
                                                </a>
                                            @endforeach
                                        </div>
                                        <div class="card-footer text-center py-0">
                                            <a href="{{route('user.notification')}}" role="button" class="btn-link text-white pb-0"><p class="mb-0">show all</p></a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @else
                            <li class="nav-item dropdown ml-1">
                                <a class="nav-link d-flex justify-content-start" id="navbarDropdownMenuLink-875" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-bell mr-n2"></i>
                                    <sup><span class="badge badge-danger">{{$userNotifications->count()}}</span></sup>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right special-color mt-3 p-0" aria-labelledby="navbarDropdownMenuLink-875">
                                    <div class="card special-color" style="width:23rem;height:25rem;">
                                        <div class="card-header d-flex justify-content-between align-items-center py-1">
                                            <span><p class="h5 text-white mb-0">Notifications</p></span>
                                            <span>
                                                <a role="button" class="btn-link text-white pb-0"><p class="mb-0">mark as read</p></a>
                                                <a role="button" class="btn-link text-white pb-0 pr-0"><p class="mb-0">clear all</p></a>
                                            </span>
                                        </div>
                                        <div class="card-body py-0 overflow-auto">
                                            @foreach ($userNotifications as $data)
                                                <a href="{{route('user.videos')}}" class="dropdown-item d-flex justify-content-between align-items-center bg-light text-dark rounded-pill p-0 my-2">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <img src="{{($data->tavatar) ? asset('storage/content/avatar/' . $data->tavatar) : asset('images/avatar.png')}}"
                                                            class="rounded-circle z-depth-1 img-fluid" width="50" height="50">
                                                        <div class="ml-4">
                                                            <div><small class="my-0 p-0"><b>{{$data->tname}}</b></small></div>
                                                            <div><small class="my-0 p-0"><b>{{$data->reqoccasion}}</b></small></div>
                                                        </div>
                                                    </div>
                                                    @if ($data->reqstatus == 'Submitted')
                                                        <span class="badge badge-success rounded-pill p-3 mr-1"><p class="mb-0 text-dark">{{$data->reqstatus}}</p></span>
                                                    @elseif ($data->reqstatus == 'Rejected')
                                                        <span class="badge badge-danger rounded-pill p-3 mr-1"><p class="mb-0 text-dark">{{$data->reqstatus}}</p></span>
                                                    @endif
                                                </a>
                                            @endforeach
                                        </div>
                                        <div class="card-footer text-center py-0">
                                            <a href="{{route('user.notification')}}" role="button" class="btn-link text-white pb-0"><p class="mb-0">show all</p></a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endif --}}
                    <li class="nav-item dropdown ml-1">
                        <a class="nav-link d-flex justify-content-start" id="navbarDropdownMenuLink-875" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell mr-n2"></i>
                            <sup><span class="badge badge-danger">{{$notifications->count()}}</span></sup>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right special-color rounded-lg mt-3 mt-3 p-0" aria-labelledby="navbarDropdownMenuLink-875">
                            <div class="card special-color" style="width:23rem;height:25rem;">
                                <div class="card-header d-flex justify-content-between align-items-center py-1">
                                    <span><p class="h5 text-white mb-0">Notifications</p></span>
                                    <span>
                                        <a role="button" class="btn-link text-white pb-0"><p class="mb-0">mark as read</p></a>
                                        <a role="button" class="btn-link text-white pb-0 pr-0"><p class="mb-0">clear all</p></a>
                                    </span>
                                </div>
                                <div class="card-body py-0 overflow-auto">
                                    @foreach ($notifications as $data)
                                        
                                    @endforeach
                                </div>
                                <div class="card-footer text-center py-0">
                                    <a href="{{route('user.notification')}}" role="button" class="btn-link text-white pb-0"><p class="mb-0">show all</p></a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown ml-2">
                        <a class="nav-link text-capitalize p-0" id="navbarDropdownMenuLink-57" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <img src="{{(auth()->user()->avatar) ? asset('storage/content/avatar/' . auth()->user()->avatar) : asset('images/avatar.png')}}"
                                class="rounded-circle z-depth-1 img-fluid" width="40" height="40">
                        </a>
                        @if (auth()->user()->type > 0)
                            <div class="dropdown-menu dropdown-menu-right special-color rounded-lg mt-3 px-2 pb-0" aria-labelledby="navbarDropdownMenuLink-57">
                                @if (auth()->user()->email_verified_at)
                                    <a class="dropdown-item rounded text-white" href="{{route('user.profile')}}">My Account</a>
                                    @if (auth()->user()->status)
                                        <a class="dropdown-item rounded text-white" href="{{route('user.request_list')}}">Requests</a>
                                        <a class="dropdown-item rounded text-white" href="{{route('user.videos')}}">My Videos</a>
                                        <a class="dropdown-item rounded text-white" href="{{route('user.following')}}">Following</a>
                                        <a class="dropdown-item rounded text-white" href="{{route('user.talent_video_archive')}}">Archive</a>
                                    @endif
                                @endif
                                <a href="{{ route('logout') }}" class="dropdown-item rounded text-white"
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();" title="Logout">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        @else
                            <div class="dropdown-menu dropdown-menu-right special-color rounded-lg mt-3 px-2 pb-0" aria-labelledby="navbarDropdownMenuLink-57">
                                @if (auth()->user()->email_verified_at)
                                    <a class="dropdown-item rounded text-white" href="{{route('user.profile')}}">My Account</a>
                                    <a class="dropdown-item rounded text-white" href="{{route('user.videos')}}">My Videos</a>
                                    <a class="dropdown-item rounded text-white" href="{{route('user.following')}}">Following</a>
                                @endif
                                <a href="{{ route('logout') }}" class="dropdown-item rounded text-white"
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();" title="Logout">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        @endif
                    </li>
                @endauth
            @endguest
        </ul>

    </div>
    <!-- Collapsible content -->

</nav>
<!--/.Navbar-->