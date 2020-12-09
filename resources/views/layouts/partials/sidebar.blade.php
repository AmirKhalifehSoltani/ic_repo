<div id="sidebar">
    @if(Auth::check())
        <div class="sidebar-top">
            <div class="user-box">
                <a href="#">
                    <img src="{{ env('PUBLIC_PATH') }}/images/user/man.png" alt="عکس پروفایل" class="img-circle img-responsive">
                </a>
                <div class="user-details">
                    <h4>{{ isset(Auth::user()->first_name) ? Auth::user()->first_name : 'حساب کاربری' }}</h4>
                    {{--                    <p class="role">مسئول فنی</p>--}}
                </div><!-- /.user-details -->
            </div><!-- /.user-box -->
        </div><!-- /.sidebar-top -->
        <div class="side-menu-container">
            <ul class="metismenu" id="side-menu">
                @if(Auth::user()->role === 1)
                    <li>
                        <a href="{{ route('admin.users') }}">
                            <i class="fa fa-user"></i>
                            <span>کاربران</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.devices') }}">
                            <i class="fa fa-microchip"></i>
                            <span>دستگاه‌ها</span>
                        </a>
                    </li>
                @elseif(Auth::user()->role === 0)
                    <li>
                        <a href="{{ route('frontend.mydevices') }}">
                            <i class="fa fa-signal"></i>
                            <span>دستگاه‌های من</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('frontend.devices') }}">
                            <i class="fa fa-signal"></i>
                            <span>مدیریت دستگاه‌ها</span>
                        </a>
                    </li>
                @endif
            </ul><!-- /#side-menu -->
        </div><!-- /.side-menu-container -->
    @endif
</div><!-- /#sidebar -->
