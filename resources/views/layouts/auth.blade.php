<!DOCTYPE html>
<html lang="fa" dir="rtl" class="rtl">
<head>
    <title>هوشمند کنترل</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="داشبورد مدیریتی هوشمند کنترل">
    <meta name="fontiran.com:license" content="NE29X">
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <link rel="shortcut icon" href="{{ env('PUBLIC_PATH') }}/images/hcfav.png">

    <!-- BEGIN CSS -->
    <link href="{{ env('PUBLIC_PATH') }}/plugins/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ env('PUBLIC_PATH') }}/plugins/bootstrap-rtl/dist/css/bootstrap-rtl.min.css" rel="stylesheet">
    <link href="{{ env('PUBLIC_PATH') }}/plugins/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <link href="{{ env('PUBLIC_PATH') }}/plugins/simple-line-icons/css/simple-line-icons.min.css" rel="stylesheet">
    <link href="{{ env('PUBLIC_PATH') }}/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ env('PUBLIC_PATH') }}/plugins/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css"
          rel="stylesheet">
    <link href="{{ env('PUBLIC_PATH') }}/plugins/switchery/dist/switchery.min.css" rel="stylesheet">
    <link href="{{ env('PUBLIC_PATH') }}/plugins/select2/dist/css/select2.min.css" rel="stylesheet">
    <link href="{{ env('PUBLIC_PATH') }}/plugins/paper-ripple/dist/paper-ripple.min.css" rel="stylesheet">
    <link href="{{ env('PUBLIC_PATH') }}/plugins/iCheck/skins/square/_all.css" rel="stylesheet">
    <link href="{{ env('PUBLIC_PATH') }}/css/style.css" rel="stylesheet">
    <link href="{{ env('PUBLIC_PATH') }}/css/colors.css" rel="stylesheet">
    <link href="{{ env('PUBLIC_PATH') }}/css/custom-style.css" rel="stylesheet">
    <!-- END CSS -->
</head>
    <body class="active-ripple theme-darkblue fix-header sidebar-extra">
        <!-- BEGIN LOEADING -->
        <div id="loader">
            <div class="spinner"></div>
        </div><!-- /loader -->
        <!-- END LOEADING -->

        <!-- BEGIN WRAPPER -->
        <div class="fixed-modal-bg"></div>
        <div class="modal-page shadow">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <div class="logo-con m-t-10 m-b-10">
                            <img src="{{ env('PUBLIC_PATH') }}/images/hcfav.png" class="center-block img-responsive">
                        </div><!-- /.logo-con -->
                        @include('layouts.partials.notifications')
                        @include('frontend.partials')
                        @yield('content')
                        {{--<hr class="m-b-30">--}}
                        {{--<a href="forget.html" class="btn btn-default btn-round btn-block m-b-10">--}}
                        {{--<i class="icon-refresh font-lg"></i>--}}
                        {{--بازیابی رمز  عبور--}}
                        {{--</a>--}}
                        {{--<a href="register.html" class="btn btn-default btn-round btn-block">--}}
                        {{--<i class="icon-user-follow font-lg"></i>--}}
                        {{--حساب ندارید، ثبت نام کنید!--}}
                        {{--</a>--}}
                    </div><!-- /.col-md-12 -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div><!-- /.modal-page -->
        <!-- END WRAPPER -->

        <!-- BEGIN JS -->
        <script src="{{ env('PUBLIC_PATH') }}/plugins/jquery/dist/jquery-1.12.4.min.js"></script>
        <script src="{{ env('PUBLIC_PATH') }}/plugins/jquery-migrate/jquery-migrate-1.2.1.min.js"></script>
        <script src="{{ env('PUBLIC_PATH') }}/plugins/popper/popper.min.js"></script>
        <script src="{{ env('PUBLIC_PATH') }}/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="{{ env('PUBLIC_PATH') }}/plugins/metisMenu/dist/metisMenu.min.js"></script>
        <script src="{{ env('PUBLIC_PATH') }}/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
        <script src="{{ env('PUBLIC_PATH') }}/plugins/paper-ripple/dist/PaperRipple.min.js"></script>
        <script src="{{ env('PUBLIC_PATH') }}/plugins/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="{{ env('PUBLIC_PATH') }}/plugins/select2/dist/js/select2.full.min.js"></script>
        <script src="{{ env('PUBLIC_PATH') }}/plugins/screenfull/dist/screenfull.min.js"></script>
        <script src="{{ env('PUBLIC_PATH') }}/plugins/iCheck/icheck.min.js"></script>
        <script src="{{ env('PUBLIC_PATH') }}/plugins/switchery/dist/switchery.js"></script>
        <script src="{{ env('PUBLIC_PATH') }}/js/core.js"></script>
        <script src="{{ env('PUBLIC_PATH') }}/js/custom.js"></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </body>
</html>