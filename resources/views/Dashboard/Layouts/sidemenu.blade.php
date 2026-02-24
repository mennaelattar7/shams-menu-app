<div id="left-sidebar" class="sidebar">
    <div class="navbar-brand">
        <a href="index.html">
            <img src="{{ asset('shams/dashboard/general_assets/assets/images/icon.svg')}}" alt="{{ trans('Dashboard.Shams') }}" class="img-fluid logo">
            <span>
                {{ trans('Dashboard.Shams') }}
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
                            <i class="fa-solid fa-house"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <!--Vendors-->
                    @if(Auth::user()->canAny([
                                                '4_create_vendor',
                                                '4_delete_vendor',
                                                '4_edit_vendor',
                                                '4_all_vendor',
                                                '4_single_vendor',
                                                '4_restore_vendor',
                                            ]))
                        <li
                        @if(Route::currentRouteName() == "dashboard.vendor.index" ||
                            Route::currentRouteName() == "dashboard.vendor.create" ||
                            Route::currentRouteName() == "dashboard.vendor.show" ||
                            Route::currentRouteName() == "dashboard.vendor.edit")
                            class="active open"
                        @endif
                        >
                            <a href="#Users" class="has-arrow">
                                <i class="fa-solid fa-store"></i>
                                <span class="font_size_14">{{ trans('Dashboard.Vendors')}}</span>
                                <span class="badge badge-info">{{ $count_vendors }}</span>
                            </a>
                            <ul>
                                <li
                                    @if(Route::currentRouteName() == "dashboard.vendor.index")
                                        class="active open"
                                    @endif
                                >
                                    <a href="{{route('dashboard.vendor.index',['locale'=>app()->getLocale()])}}">
                                        {{ trans('Dashboard.Show')}}
                                    </a>
                                </li>
                                <li
                                    @if(Route::currentRouteName() == "dashboard.vendor.create")
                                        class="active open"
                                    @endif
                                >
                                    <a href="{{route('dashboard.vendor.create',['locale'=>app()->getLocale()])}}">
                                        {{ trans('Dashboard.Create')}}
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    @if(Auth::user()->canAny([
                                                '1_create_user',
                                                '1_delete_user',
                                                '1_edit_user',
                                                '1_all_user',
                                                '1_archived_user',
                                                '1_single_user',
                                                '1_restore_user',
                                                '1_delete_permanently_user',

                                                '2_create_role',
                                                '2_delete_role',
                                                '2_edit_role',
                                                '2_all_role',
                                                '2_single_role',
                                                '2_restore_role',

                                                '3_create_permission',
                                                '3_delete_permission',
                                                '3_edit_permission',
                                                '3_all_permission',
                                                '3_single_permission',
                                                '3_restore_permission'
                                            ]))

                        <li class="header">
                            {{ trans('Dashboard.Users_And_Permissions')}}
                        </li>
                    @endif
                    <!--Users-->
                    @if(Auth::user()->canAny([
                                                '1_create_user',
                                                '1_delete_user',
                                                '1_edit_user',
                                                '1_all_user',
                                                '1_archived_user',
                                                '1_single_user',
                                                '1_restore_user',
                                                '1_delete_permanently_user'
                                            ]))
                        <li
                        @if(Route::currentRouteName() == "dashboard.user.index" ||
                            Route::currentRouteName() == "dashboard.user.show" ||
                            Route::currentRouteName() == "dashboard.user.edit"||
                            Route::currentRouteName() == "dashboard.user.create")
                            class="active open"
                        @endif
                        >
                            <a href="#vendor" class="has-arrow"
                                @if(Route::currentRouteName() == "dashboard.user.index" ||
                                    Route::currentRouteName() == "dashboard.user.show" ||
                                    Route::currentRouteName() == "dashboard.user.edit"||
                                    Route::currentRouteName() == "dashboard.user.create")
                                    style="color:#F4CE6A;text-decoration: underline;"
                                @endif
                            >
                            @if(Route::currentRouteName() == "dashboard.user.index" ||
                                Route::currentRouteName() == "dashboard.user.show" ||
                                Route::currentRouteName() == "dashboard.user.edit"||
                                Route::currentRouteName() == "dashboard.user.create")
                                <i class="icon-check"></i>
                            @else
                                <i class="fa-solid fa-user"></i>
                            @endif
                                <span class="font_size_14" >{{ trans('Dashboard.Users')}}</span>
                                <span class="badge badge-info" style="color: #F4CE6A">{{$count_users}}</span>
                            </a>
                            <ul>
                                @if(Auth::user()->can([
                                    '1_all_user',
                                ]))
                                    <li
                                        @if(Route::currentRouteName() == "dashboard.user.index")
                                            class="active open"
                                        @endif
                                    >
                                        <a href="{{route('dashboard.user.index',['locale'=>app()->getLocale()])}}"
                                            @if(Route::currentRouteName() == "dashboard.user.index")
                                                style="background-color: #e4f3f5;"
                                            @endif
                                            >
                                            {{ trans('Dashboard.Show')}}
                                        </a>
                                    </li>
                                @endif
                                @if(Auth::user()->can([
                                    '1_create_user'
                                ]))
                                    <li
                                        @if(Route::currentRouteName() == "dashboard.user.create")
                                            class="active open"
                                        @endif
                                    >
                                        <a href="{{route('dashboard.user.create',['locale'=>app()->getLocale()])}}"
                                            @if(Route::currentRouteName() == "dashboard.user.create")
                                                style="background-color: #e4f3f5;"
                                            @endif
                                        >
                                            {{ trans('Dashboard.Create')}}
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    <!--Roles-->
                    @if(Auth::user()->canAny([
                                                '2_create_role',
                                                '2_delete_role',
                                                '2_edit_role',
                                                '2_all_role',
                                                '2_single_role',
                                                '2_restore_role',
                                            ]))
                        <li
                        @if(Route::currentRouteName() == "dashboard.role.index" ||
                            Route::currentRouteName() == "dashboard.role.create" ||
                            Route::currentRouteName() == "dashboard.role.show" ||
                            Route::currentRouteName() == "dashboard.role.edit")
                            class="active open"
                        @endif
                        >
                            <a href="#Users" class="has-arrow">
                                <i class="fa-solid fa-user-shield"></i>
                                <span class="font_size_14">{{ trans('Dashboard.Roles')}}</span>
                                <span class="badge badge-info">{{ $count_roles }}</span>
                            </a>
                            <ul>
                                <li
                                    @if(Route::currentRouteName() == "dashboard.role.index")
                                        class="active open"
                                    @endif
                                >
                                    <a href="{{route('dashboard.role.index',['locale'=>app()->getLocale()])}}">
                                        {{ trans('Dashboard.Show')}}
                                    </a>
                                </li>
                                <li
                                    @if(Route::currentRouteName() == "dashboard.role.create")
                                        class="active open"
                                    @endif
                                >
                                    <a href="{{route('dashboard.role.create',['locale'=>app()->getLocale()])}}">
                                        {{ trans('Dashboard.Create')}}
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    <!--Permissions-->
                    @if(Auth::user()->canAny([
                                                '3_create_permission',
                                                '3_delete_permission',
                                                '3_edit_permission',
                                                '3_all_permission',
                                                '3_single_permission',
                                                '3_restore_permission'
                                            ]))
                        <li
                        @if(Route::currentRouteName() == "dashboard.permission.index" ||
                            Route::currentRouteName() == "dashboard.permission.create" ||
                            Route::currentRouteName() == "dashboard.permission.show" ||
                            Route::currentRouteName() == "dashboard.permission.edit")
                            class="active open"
                        @endif
                        >
                            <a href="#Users" class="has-arrow">
                                <i class="fa-solid fa-key"></i>
                                <span class="font_size_14">{{ trans('Dashboard.Permissions')}}</span>
                                <span class="badge badge-info">{{ $count_permissions }}</span>
                            </a>
                            <ul>
                                <li
                                @if(Route::currentRouteName() == "dashboard.permission.index")
                                    class="active open"
                                @endif
                                >
                                    <a href="{{route('dashboard.permission.index',['locale'=>app()->getLocale()])}}">
                                        {{ trans('Dashboard.Show')}}
                                    </a>
                                </li>
                                <li
                                @if(Route::currentRouteName() == "dashboard.permission.create")
                                    class="active open"
                                @endif
                                >
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
</div>
