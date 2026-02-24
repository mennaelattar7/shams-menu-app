            <nav class="navbar top-navbar">
                <div class="container-fluid navbar-container">
                    <div class="navbar-left">
                        <div class="navbar-btn">
                            <a href="index.html">
                                <img src="{{ asset('shams/dashboard/general_assets/assets/images/icon.svg')}}" alt="Oculux Logo" class="img-fluid logo">
                            </a>
                            <button type="button" class="btn-toggle-offcanvas"><i class="lnr lnr-menu fa fa-bars"></i></button>
                        </div>
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                                    <i class="icon-envelope"></i>
                                    <span class="notification-dot bg-green">4</span>
                                </a>
                                <ul class="dropdown-menu right_chat email vivify fadeIn">
                                    <li class="header green">You have 4 New eMail</li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="media">
                                                <div class="avtar-pic w35 bg-red"><span>FC</span></div>
                                                <div class="media-body">
                                                    <span class="name">James Wert <small class="float-right text-muted">Just now</small></span>
                                                    <span class="message">Update GitHub</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="media">
                                                <div class="avtar-pic w35 bg-indigo"><span>FC</span></div>
                                                <div class="media-body">
                                                    <span class="name">Folisise Chosielie <small class="float-right text-muted">12min ago</small></span>
                                                    <span class="message">New Messages</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="media">
                                                <img class="media-object " src="{{ asset('shams/dashboard/general_assets/assets/images/xs/avatar5.jpg')}}" alt="">
                                                <div class="media-body">
                                                    <span class="name">Louis Henry <small class="float-right text-muted">38min ago</small></span>
                                                    <span class="message">Design bug fix</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="mb-0 media">
                                                <img class="media-object " src="{{ asset('shams/dashboard/general_assets/assets/images/xs/avatar2.jpg')}}" alt="">
                                                <div class="media-body">
                                                    <span class="name">Debra Stewart <small class="float-right text-muted">2hr ago</small></span>
                                                    <span class="message">Fix Bug</span>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                                    <i class="icon-bell"></i>
                                    <span class="notification-dot bg-azura">4</span>
                                </a>
                                <ul class="dropdown-menu feeds_widget vivify fadeIn">
                                    <li class="header blue">You have 4 New Notifications</li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="feeds-left bg-red"><i class="fa fa-check"></i></div>
                                            <div class="feeds-body">
                                                <h4 class="title text-danger">Issue Fixed <small class="float-right text-muted">9:10 AM</small></h4>
                                                <small>WE have fix all Design bug with Responsive</small>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="feeds-left bg-info"><i class="fa fa-user"></i></div>
                                            <div class="feeds-body">
                                                <h4 class="title text-info">New User <small class="float-right text-muted">9:15 AM</small></h4>
                                                <small>I feel great! Thanks team</small>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="feeds-left bg-orange"><i class="fa fa-question-circle"></i></div>
                                            <div class="feeds-body">
                                                <h4 class="title text-warning">Server Warning <small class="float-right text-muted">9:17 AM</small></h4>
                                                <small>Your connection is not private</small>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="feeds-left bg-green"><i class="fa fa-thumbs-o-up"></i></div>
                                            <div class="feeds-body">
                                                <h4 class="title text-success">2 New Feedback <small class="float-right text-muted">9:22 AM</small></h4>
                                                <small>It will give a smart finishing to your site</small>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown language-menu">
                                <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                                    <i class="fa fa-language"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="pt-2 pb-2 dropdown-item" href="#"><img src="{{ asset('shams/dashboard/general_assets/assets/images/flag/us.svg')}}" class="mr-2 w20 rounded-circle"> US English</a>
                                    <a class="pt-2 pb-2 dropdown-item" href="#"><img src="{{ asset('shams/dashboard/general_assets/assets/images/flag/gb.svg')}}" class="mr-2 w20 rounded-circle"> UK English</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="pt-2 pb-2 dropdown-item" href="#"><img src="{{ asset('shams/dashboard/general_assets/assets/images/flag/russia.svg')}}" class="mr-2 w20 rounded-circle"> Russian</a>
                                    <a class="pt-2 pb-2 dropdown-item" href="#"><img src="{{ asset('shams/dashboard/general_assets/assets/images/flag/arabia.svg')}}" class="mr-2 w20 rounded-circle"> Arabic</a>
                                    <a class="pt-2 pb-2 dropdown-item" href="#"><img src="{{ asset('shams/dashboard/general_assets/assets/images/flag/france.svg')}}" class="mr-2 w20 rounded-circle"> French</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="navbar-center">
                        <ul class="nav navbar-nav">
                            <li class="nav-item active">
                                <a href="#" class="navbar-title">{{ trans('Dashboard.Main') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="##" class="navbar-title">{{ trans('Dashboard.Technical_Support') }} </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="navbar-title">{{ trans('Dashboard.Data_Entry') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="navbar-title">{{ trans('Dashboard.Customer_Service') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="navbar-title">{{ trans('Dashboard.Sales') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="navbar-title">{{ trans('Dashboard.HR') }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="navbar-right">
                        <div id="navbar-menu">
                            <ul class="nav navbar-nav">
                                <li><a href="javascript:void(0);" class="search_toggle icon-menu" title="Search Result"><i class="icon-magnifier"></i></a></li>
                                <li><a href="javascript:void(0);" class="right_toggle icon-menu" title="Right Menu"><i class="icon-bubbles"></i><span class="notification-dot bg-pink">2</span></a></li>
                                <li><a href="page-login.html" class="icon-menu"><i class="icon-power"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="progress-container"><div class="progress-bar" id="myBar"></div></div>
            </nav>
