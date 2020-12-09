<div class="navbar navbar-fixed-top" id="main-navbar">
    <div class="header-right">
        <a href="{{ route('admin.users') }}" class="logo-con">
            <img src="{{ env('PUBLIC_PATH') }}/images/hcfav.png" class="img-responsive center-block">
        </a>
    </div><!-- /.header-right -->
    <div class="header-left">
        <div class="top-bar">
            @if(Auth::check())
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="#" class="btn" id="toggle-sidebar">
                            <span></span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="btn open" id="toggle-sidebar-top">
                            <i class="icon-user-following"></i>
                        </a>
                    </li>
                </ul>
                {{--<div class="nav navbar-nav" style="display: inline-block;">--}}
                    {{--<span id="current-date"></span>--}}
                    {{--<i class="icon-calendar"></i>--}}
                {{--</div>--}}
                <ul class="nav navbar-nav navbar-left">
                    <li class="show_current_date">
                        <a href="#">
                            <span id="current-date"></span>
                            <i class="btn icon-calendar"></i>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="btn" id="toggle-fullscreen">
                            <i class="icon-size-fullscreen"></i>
                        </a>
                    </li>
                    <li class="dropdown dropdown-user">
                        <a href="#" class="dropdown-toggle dropdown-hover" data-toggle="dropdown">
                            <img src="{{ env('PUBLIC_PATH') }}/images/user/man48.png" alt="عکس پرفایل" class="img-circle img-responsive">
                            <span>{{ isset(Auth::user()->first_name) ? Auth::user()->first_name : 'حساب کاربری' }}</span>
                            <i class="icon-arrow-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ route('logout') }}">
                                    <i class="icon-power"></i>
                                    خروج
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul><!-- /.navbar-left -->
            @else
                <ul class="nav navbar-nav navbar-left">
                    <li class="dropdown dropdown-user">
                        <a class="dropdown-toggle dropdown-hover" href="{{ route('signin') }}">
                            <span> ورود </span><i class="icon-login"></i>
                        </a>
                    </li>
                    {{--<li class="dropdown dropdown-user">--}}
                        {{--<a class="dropdown-toggle dropdown-hover" href="{{ route('registeration') }}">--}}
                            {{--<span> ثبت نام </span><i class="fa fa-user-plus"></i>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                </ul><!-- /.navbar-left -->
            @endif
        </div><!-- /.top-bar -->
    </div><!-- /.header-left -->
</div><!-- /.navbar -->