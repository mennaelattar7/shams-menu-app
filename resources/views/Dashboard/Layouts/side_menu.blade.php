<div id="left-sidebar" class="sidebar">
    <div class="navbar-brand">
        <a href="index.html">
            <img src="{{ asset('shams/dashboard/general_assets/assets/images/icon.svg')}}" alt="{{ trans('dashboard.Shams') }}" class="img-fluid logo">
            <span>
                {{ trans('dashboard.Shams') }}
            </span>
        </a>
        <button type="button" class="float-right btn-toggle-offcanvas btn btn-sm">
            <i class="lnr lnr-menu icon-close"></i>
        </button>
    </div>
    <div class="sidebar-scroll custom-scroll">
        <div class="sidebar-inner">
            <div class="user-account">
                <div class="user_div">
                    <img src="{{ asset('shams/dashboard/general_assets/assets/images/user.png')}}" class="user-photo" alt="User Profile Picture">
                </div>
                <div class="dropdown">
                    <span>
                        {{ trans('dashboard.Hi') }},
                    </span>
                    <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown">
                        <strong>
                            {{ Auth::user()->name }}
                        </strong>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right account vivify flipInY">
                        <li><a href="page-profile.html"><i class="icon-user"></i>My Profile</a></li>
                        <li><a href="app-inbox.html"><i class="icon-envelope-open"></i>Messages</a></li>
                        <li><a href="javascript:void(0);"><i class="icon-settings"></i>Settings</a></li>
                        <li class="divider" style="color: red"></li>
                        <li><a href="page-login.html"><i class="icon-power"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
            <nav id="left-sidebar-nav" class="sidebar-nav">
                <ul id="main-menu" class="metismenu">
                    <li class="header">Main</li>
                    <li class="active open">
                        <a href="#myPage">
                            <i class="icon-home"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="header">Shams Structure</li>
                    <li>
                        <a href="#myPage" class="has-arrow">
                            <i class="icon-home"></i>
                            <span>
                                Departments
                            </span>
                        </a>
                        <ul>
                            <li class="active">
                                <a href="index.html">
                                    All
                                </a>
                            </li>
                            <li>
                                <a href="index4.html">
                                    Create
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#myPage" class="has-arrow">
                            <i class="icon-home"></i>
                            <span>
                                Employees
                            </span>
                        </a>
                        <ul>
                            <li class="active">
                                <a href="index.html">
                                    All
                                </a>
                            </li>
                            <li>
                                <a href="index4.html">
                                    Create
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#myPage" class="has-arrow">
                            <i class="icon-home"></i>
                            <span>
                                Positions
                            </span>
                        </a>
                        <ul>
                            <li class="active">
                                <a href="index.html">
                                    All
                                </a>
                            </li>
                            <li>
                                <a href="index4.html">
                                    Create
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="header">Roles & Permissions</li>
                    <li>
                        <a href="#myPage" class="has-arrow">
                            <i class="icon-home"></i>
                            <span>
                                Roles
                            </span>
                        </a>
                        <ul>
                            <li class="active">
                                <a href="index.html">
                                    All
                                </a>
                            </li>
                            <li>
                                <a href="index4.html">
                                    Create
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#myPage" class="has-arrow">
                            <i class="icon-home"></i>
                            <span>
                                Permissions
                            </span>
                        </a>
                        <ul>
                            <li class="active">
                                <a href="index.html">
                                    All
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#myPage" class="has-arrow">
                            <i class="icon-home"></i>
                            <span>
                                Users
                            </span>
                        </a>
                        <ul>
                            <li class="active">
                                <a href="index.html">
                                    All
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
