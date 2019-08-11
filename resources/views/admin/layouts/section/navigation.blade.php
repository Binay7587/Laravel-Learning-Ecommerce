<!-- START HEADER-->
<header class="header">
    <div class="page-brand">
        <a class="link" href="{{ route('home') }}">
                    <span class="brand">Admin
                        <span class="brand-tip">Nayabazar</span>
                    </span>
            <span class="brand-mini">AC</span>
        </a>
    </div>
    <div class="flexbox flex-1">
        <!-- START TOP-LEFT TOOLBAR-->
        <ul class="nav navbar-toolbar">
            <li>
                <a class="nav-link sidebar-toggler js-sidebar-toggler"><i class="ti-menu"></i></a>
            </li>

        </ul>
        <!-- END TOP-LEFT TOOLBAR-->
        <!-- START TOP-RIGHT TOOLBAR-->
        <ul class="nav navbar-toolbar">
            {{--<li class="dropdown dropdown-inbox">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope-o"></i>
                    <span class="badge badge-primary envelope-badge">9</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right dropdown-menu-media">
                    <li class="dropdown-menu-header">
                        <div>
                            <span><strong>9 New</strong> Messages</span>
                            <a class="pull-right" href="mailbox.html">view all</a>
                        </div>
                    </li>
                    <li class="list-group list-group-divider scroller" data-height="240px" data-color="#71808f">
                        <div>
                            <a class="list-group-item">
                                <div class="media">
                                    <div class="media-img">
                                        <img src="{{ asset('img/users/u1.jpg') }}" />
                                    </div>
                                    <div class="media-body">
                                        <div class="font-strong"> </div>Jeanne Gonzalez<small class="text-muted float-right">Just now</small>
                                        <div class="font-13">Your proposal interested me.</div>
                                    </div>
                                </div>
                            </a>
                            <a class="list-group-item">
                                <div class="media">
                                    <div class="media-img">
                                        <img src="{{ asset('img/users/u2.jpg') }}" />
                                    </div>
                                    <div class="media-body">
                                        <div class="font-strong"></div>Becky Brooks<small class="text-muted float-right">18 mins</small>
                                        <div class="font-13">Lorem Ipsum is simply.</div>
                                    </div>
                                </div>
                            </a>
                            <a class="list-group-item">
                                <div class="media">
                                    <div class="media-img">
                                        <img src="{{ asset('img/users/u3.jpg') }}" />
                                    </div>
                                    <div class="media-body">
                                        <div class="font-strong"></div>Frank Cruz<small class="text-muted float-right">18 mins</small>
                                        <div class="font-13">Lorem Ipsum is simply.</div>
                                    </div>
                                </div>
                            </a>
                            <a class="list-group-item">
                                <div class="media">
                                    <div class="media-img">
                                        <img src="{{ asset('img/users/u4.jpg') }}" />
                                    </div>
                                    <div class="media-body">
                                        <div class="font-strong"></div>Rose Pearson<small class="text-muted float-right">3 hrs</small>
                                        <div class="font-13">Lorem Ipsum is simply.</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </li>
                </ul>
            </li>
            <li class="dropdown dropdown-notification">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell-o rel"><span class="notify-signal"></span></i></a>
                <ul class="dropdown-menu dropdown-menu-right dropdown-menu-media">
                    <li class="dropdown-menu-header">
                        <div>
                            <span><strong>5 New</strong> Notifications</span>
                            <a class="pull-right" href="javascript:;">view all</a>
                        </div>
                    </li>
                    <li class="list-group list-group-divider scroller" data-height="240px" data-color="#71808f">
                        <div>
                            <a class="list-group-item">
                                <div class="media">
                                    <div class="media-img">
                                        <span class="badge badge-success badge-big"><i class="fa fa-check"></i></span>
                                    </div>
                                    <div class="media-body">
                                        <div class="font-13">4 task compiled</div><small class="text-muted">22 mins</small></div>
                                </div>
                            </a>
                            <a class="list-group-item">
                                <div class="media">
                                    <div class="media-img">
                                        <span class="badge badge-default badge-big"><i class="fa fa-shopping-basket"></i></span>
                                    </div>
                                    <div class="media-body">
                                        <div class="font-13">You have 12 new orders</div><small class="text-muted">40 mins</small></div>
                                </div>
                            </a>
                            <a class="list-group-item">
                                <div class="media">
                                    <div class="media-img">
                                        <span class="badge badge-danger badge-big"><i class="fa fa-bolt"></i></span>
                                    </div>
                                    <div class="media-body">
                                        <div class="font-13">Server #7 rebooted</div><small class="text-muted">2 hrs</small></div>
                                </div>
                            </a>
                            <a class="list-group-item">
                                <div class="media">
                                    <div class="media-img">
                                        <span class="badge badge-success badge-big"><i class="fa fa-user"></i></span>
                                    </div>
                                    <div class="media-body">
                                        <div class="font-13">New user registered</div><small class="text-muted">2 hrs</small></div>
                                </div>
                            </a>
                        </div>
                    </li>
                </ul>
            </li>--}}
            <li class="dropdown dropdown-user">
                <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                    <img src="{{ asset('img/admin-avatar.png') }}" />
                    <span></span>{{ auth()->user()->name }}<i class="fa fa-angle-down m-l-5"></i></a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.html"><i class="fa fa-user"></i>Profile</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="fa fa-power-off"></i>{{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </ul>
            </li>
        </ul>
        <!-- END TOP-RIGHT TOOLBAR-->
    </div>
</header>
<!-- END HEADER-->
<!-- START SIDEBAR-->
<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex">
            <div>
                <img src="{{ asset('img/admin-avatar.png') }}" width="45px" />
            </div>
            <div class="admin-info">
                <div class="font-strong">{{ auth()->user()->name }}</div><small>{{ ucfirst(auth()->user()->role) }}</small></div>
        </div>
        <ul class="side-menu metismenu">
            <li>
                <a class="active" href="{{ route('home') }}"><i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
            <li class="heading">FEATURES</li>
            <li>
                <a href="{{ route('banner.index') }}">
                    <i class="sidebar-item-icon fa fa-image"></i>
                    <span class="nav-label">Banner Management</span>
                    <i class="fa fa-angle-left arrow"></i>
                </a>
            </li>
            <li>
                <a href="{{ route('category.index') }}">
                    <i class="sidebar-item-icon fa fa-sitemap"></i>
                    <span class="nav-label">Category Management</span>
                    <i class="fa fa-angle-left arrow"></i>
                </a>
            </li>
            <li>
                <a href="{{ route('product.index') }}">
                    <i class="sidebar-item-icon fa fa-shopping-bag"></i>
                    <span class="nav-label">Products Management</span>
                    <i class="fa fa-angle-left arrow"></i>
                </a>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="sidebar-item-icon fa fa-shopping-cart"></i>
                    <span class="nav-label">Order Management</span>
                    <i class="fa fa-angle-left arrow"></i>
                </a>
            </li>

            <li>
                <a href="javascript:;">
                    <i class="sidebar-item-icon fa fa-users"></i>
                    <span class="nav-label">User Management</span>
                    <i class="fa fa-angle-left arrow"></i>
                </a>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="sidebar-item-icon fa fa-gift"></i>
                    <span class="nav-label">Offer Management</span>
                    <i class="fa fa-angle-left arrow"></i>
                </a>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="sidebar-item-icon fa fa-comments"></i>
                    <span class="nav-label">Reviews Management</span>
                    <i class="fa fa-angle-left arrow"></i>
                </a>
            </li>
            <li>
                <a href="{{ route('pages.index') }}">
                    <i class="sidebar-item-icon fa fa-file"></i>
                    <span class="nav-label">Pages Management</span>
                    <i class="fa fa-angle-left arrow"></i>
                </a>
            </li>
            <li>
                <a href="{{ route('file-manager') }}">
                    <i class="sidebar-item-icon fa fa-file-archive-o"></i>
                    <span class="nav-label">File Manager</span>
                    <i class="fa fa-angle-left arrow"></i>
                </a>

        </ul>
    </div>
</nav>
<!-- END SIDEBAR-->
