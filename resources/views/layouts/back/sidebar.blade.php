<div class="sidebar" data-color="purple" data-background-color="black" data-image="{{asset('images/bak-img/sidebar-2.jpg')}}">
    <div class="logo">
        <a href="{{route('home')}}" class="simple-text logo-normal text-light">
            <img src="{{asset('images/logo.png')}}" height="35" alt="Oplly logo">
            {{-- {{ config('app.name') }} --}}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav accordion" id="sidenavbar">
            <li class="nav-item z-depth-0 {{request()->routeIs('admin.dashboard') ? 'active' : ''}}">
                <a href="{{route('admin.dashboard')}}" class="nav-link collapsed" role="button">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item z-depth-0 {{request()->routeIs('admin.request') ? 'active' : ''}}">
                <a href="{{route('admin.request')}}" class="nav-link collapsed" role="button">
                    <i class="material-icons">assignment</i>
                    <p>Client Requset</p>
                </a>
            </li>
            <li class="nav-item z-depth-0 {{request()->routeIs('admin.userAcc.*') ? 'active' : ''}}" id="sidebarHeadingOne">
                <a href="#!" class="nav-link {{request()->routeIs('admin.userAcc.*') ? '' : 'collapsed'}}" role="button" data-toggle="collapse" data-target="#sidebarCollapseOne" aria-expanded="true" aria-controls="sidebarCollapseOne">
                    <i class="material-icons">people</i>
                    <p>User Accounts</p>
                </a>
                <div id="sidebarCollapseOne" class="collapse {{request()->routeIs('admin.userAcc.*') ? 'show' : ''}} mt-2" aria-labelledby="sidebarHeadingOne" data-parent="#sidenavbar">
                    <ul class="list-group">
                        <li class="list-group-item nav-item py-0">
                            <a class="nav-link d-flex align-items-center my-0" href="{{route('admin.userAcc.clients')}}">
                                <i class="material-icons">person</i>
                                <p>Client</p>
                            </a>
                        </li>
                        <li class="list-group-item nav-item py-0">
                            <a class="nav-link d-flex align-items-center my-0" href="{{route('admin.userAcc.talents')}}">
                                <i class="material-icons">person</i>
                                <p>Talent</p>
                            </a>
                        </li>
                        @if (auth()->user()->level < 3)
                            <li class="list-group-item nav-item py-0">
                                <a class="nav-link d-flex align-items-center my-0" href="{{route('admin.userAcc.admins')}}">
                                    <i class="material-icons">person</i>
                                    <p>Admin</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </li>
            @if (auth()->user()->level < 3)
            <li class="nav-item z-depth-0 {{request()->routeIs('admin.setting.*') ? 'active' : ''}}" id="sidebarHeadingThree">
                <a href="#!" class="nav-link {{request()->routeIs('admin.setting.*') ? '' : 'collapsed'}}" role="button" data-toggle="collapse" data-target="#sidebarCollapseThree" aria-expanded="true" aria-controls="sidebarCollapseThree">
                    <i class="material-icons">settings_applications</i>
                    <p>Settings</p>
                </a>
                <div id="sidebarCollapseThree" class="collapse {{request()->routeIs('admin.setting.*') ? 'show' : ''}} mt-2" aria-labelledby="sidebarHeadingThree" data-parent="#sidenavbar">
                    <ul class="list-group">
                        <li class="list-group-item nav-item py-0">
                            <a class="nav-link d-flex align-items-center my-0" href="{{route('admin.setting.accounts')}}">
                                <i class="material-icons">account_balance</i>
                                <p>Accounts</p>
                            </a>
                        </li>
                        <li class="list-group-item nav-item py-0">
                            <a class="nav-link d-flex align-items-center my-0" href="{{route('admin.setting.promotion')}}">
                                <i class="material-icons">local_offer</i>
                                <p>Promotion</p>
                            </a>
                        </li>
                        <li class="list-group-item nav-item py-0">
                            <a class="nav-link d-flex align-items-center my-0" href="{{route('admin.setting.company.category')}}">
                                <i class="material-icons">style</i>
                                <p>Categories & Tags</p>
                            </a>
                        </li>
                        <li class="list-group-item nav-item py-0">
                            <a class="nav-link d-flex align-items-center my-0" href="{{route('admin.setting.company')}}">
                                <i class="material-icons">settings</i>
                                <p>Company</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif
        </ul>
    </div>
</div>