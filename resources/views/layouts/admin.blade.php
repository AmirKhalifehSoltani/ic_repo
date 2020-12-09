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
    <link href="{{ env('PUBLIC_PATH') }}/plugins/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet">
    <link href="{{ env('PUBLIC_PATH') }}/plugins/switchery/dist/switchery.min.css" rel="stylesheet">
    <link href="{{ env('PUBLIC_PATH') }}/plugins/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="{{ env('PUBLIC_PATH') }}/plugins/select2/dist/css/select2.min.css" rel="stylesheet">
    <link href="{{ env('PUBLIC_PATH') }}/plugins/paper-ripple/dist/paper-ripple.min.css" rel="stylesheet">
    <link href="{{ env('PUBLIC_PATH') }}/plugins/iCheck/skins/square/_all.css" rel="stylesheet">
    <link href="{{ env('PUBLIC_PATH') }}/plugins/data-table/DataTables-1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="{{ env('PUBLIC_PATH') }}/css/style.css" rel="stylesheet">
    <link href="{{ env('PUBLIC_PATH') }}/css/colors.css" rel="stylesheet">
    <link href="{{ env('PUBLIC_PATH') }}/css/custom-style.css" rel="stylesheet">
    <!-- END CSS -->

    <script src="{{ env('PUBLIC_PATH') }}/plugins/persian-date/persian-date.min.js"></script>

</head>
<body class="active-ripple theme-darkblue fix-header sidebar-extra">
<!-- BEGIN LOEADING -->
<div id="loader">
    <div class="spinner"></div>
</div><!-- /loader -->
<!-- END LOEADING -->

<!-- BEGIN HEADER -->
@include('layouts.partials.header')
<!-- END HEADER -->

<!-- BEGIN WRAPPER -->
<div id="wrapper">

    <!-- BEGIN SIDEBAR -->
@include('layouts.partials.sidebar')
<!-- END SIDEBAR -->

    <!-- BEGIN PAGE CONTENT -->
    <div id="page-content">
        <div class="row">
            <!-- BEGIN BREADCRUMB -->
        {{--<div class="col-md-12">--}}
        {{--<div class="breadcrumb-box border shadow">--}}
        {{--<ul class="breadcrumb">--}}
        {{--<li><a href="#"></a></li>--}}
        {{--<li><a href="#"></a></li>--}}
        {{--</ul>--}}
        {{--<div class="breadcrumb-left">--}}
        {{--<span id="current-date"></span>--}}
        {{--<i class="icon-calendar"></i>--}}
        {{--</div><!-- /.breadcrumb-left -->--}}
        {{--</div><!-- /.breadcrumb-box -->--}}
        {{--</div><!-- /.col-md-12 -->--}}
        <!-- END BREADCRUMB -->
            <div class="col-12">
                <div class="portlet box border shadow">
                    <div class="portlet-heading">
                        <div class="portlet-title">
                            <h3 class="title">
                                <i class="icon-chart"></i>
                                {{ isset($panel_title) ? $panel_title : ''  }}
                            </h3>
                            @if(isset($make_new))
                                <a href="{{ $make_new }}" class="make_new btn btn-primary">ثبت جدید</a>
                            @endif
                        </div><!-- /.portlet-title -->
                        <div class="buttons-box">
                            <a class="btn btn-sm btn-default btn-round btn-fullscreen" rel="tooltip" title="تمام صفحه"
                               href="#">
                                <i class="icon-size-fullscreen"></i>
                            </a>
                            <a class="btn btn-sm btn-default btn-round btn-collapse" rel="tooltip" title="کوچک کردن"
                               href="#">
                                <i class="icon-arrow-up"></i>
                            </a>
                        </div><!-- /.buttons-box -->
                    </div><!-- /.portlet-heading -->
                    <div class="portlet-body">
                        @include('layouts.partials.notifications')
                        @include('frontend.partials')
                        @yield('content')
                    </div>
                </div><!-- /.portlet-body -->
            </div><!-- /.portlet -->
        </div><!-- /.col-12 -->
    </div><!-- /.row -->
</div><!-- /#page-content -->
<!-- END PAGE CONTENT -->

</div><!-- /#wrapper -->
<!-- END WRAPPER -->

<div class="row footer-container">
    <div class="col-md-12">
        <div class="copyright">
            <p class="pull-right">
                کلیه حقوق برای هوشمند کنترل محفوظ است.
            </p>
            <p class="pull-left ltr tahoma">
                Designed By
                <a href="https://www.linkedin.com/in/amir-khalifehsoltani/">Amir Khalifeh Soltani</a>
                <a href="tel:+989125773476">+989125773476</a>
            </p>
        </div><!-- /.copyright -->
    </div><!-- /.col-md-12 -->
</div><!-- /.row -->

<!-- BEGIN SETTING -->
<div class="settings d-none d-sm-block">
    <a href="#" class="btn" id="toggle-setting">
        <i class="icon-settings"></i>
        <div class="paper-ripple">
            <div class="paper-ripple__background" style="opacity: 0.005448;"></div>
            <div class="paper-ripple__waves"></div>
        </div>
    </a>
    <h3 class="text-center">تنظیمات</h3>

    <div class="fix-header-box">
        <p class="h6">
            هدر ثابت:
            <span class="pull-left">
                <input type="checkbox" class="fix-header-switch normal" checked="" data-switchery="true"
                       style="display: none;">
                {{--<span class="switchery switchery-small" style="background-color: rgb(153, 153, 153); border-color: rgb(153, 153, 153); box-shadow: rgb(153, 153, 153) 0px 0px 0px 11px inset; transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s, background-color 1.2s ease 0s;"><small style="left: 13px; transition: background-color 0.4s ease 0s, left 0.2s ease 0s; background-color: rgb(255, 255, 255);"></small></span>--}}
            </span>
        </p>
    </div><!-- /.fix-header-box -->
    <hr class="light">
    <div class="toggle-sidebar-box">
        <p class="h6">
            جمع کردن سایدبار:
            <span class="pull-left">
                <input type="checkbox" class="toggle-sidebar-switch normal" data-switchery="true"
                       style="display: none;">
                {{--<span class="switchery switchery-small" style="box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; border-color: rgb(223, 223, 223); background-color: rgb(255, 255, 255); transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s;"><small style="left: 0px; transition: background-color 0.4s ease 0s, left 0.2s ease 0s;"></small></span>--}}
            </span>
        </p>
    </div><!-- /.toggle-sidebar-box -->
    <hr class="light">
    <div class="toggle-sidebar-box">
        <p class="h6">
            سایدبار خلاقانه:
            <span class="pull-left">
                <input type="checkbox" class="creative-sidebar-switch normal" data-switchery="true"
                       style="display: none;">
                {{--<span class="switchery switchery-small" style="box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; border-color: rgb(223, 223, 223); background-color: rgb(255, 255, 255); transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s;"><small style="left: 0px; transition: background-color 0.4s ease 0s, left 0.2s ease 0s;"></small></span>--}}
            </span>
        </p>
    </div><!-- /.toggle-sidebar-box -->
    <hr class="light">
    <div class="theme-colors">
        <p class="h6">رنگ قالب : </p>
        <a class="btn btn-round btn-blue ripple-effect active" data-color="blue">
            <div class="paper-ripple">
                <div class="paper-ripple__background"></div>
                <div class="paper-ripple__waves"></div>
            </div>
        </a>
        <a class="btn btn-round btn-red ripple-effect" data-color="red">
            <div class="paper-ripple">
                <div class="paper-ripple__background"></div>
                <div class="paper-ripple__waves"></div>
            </div>
        </a>
        <a class="btn btn-round btn-green ripple-effect" data-color="green">
            <div class="paper-ripple">
                <div class="paper-ripple__background"></div>
                <div class="paper-ripple__waves"></div>
            </div>
        </a>
        <a class="btn btn-round btn-orange ripple-effect" data-color="orange">
            <div class="paper-ripple">
                <div class="paper-ripple__background"></div>
                <div class="paper-ripple__waves"></div>
            </div>
        </a>
        <a class="btn btn-round btn-darkblue ripple-effect" data-color="darkblue">
            <div class="paper-ripple">
                <div class="paper-ripple__background"></div>
                <div class="paper-ripple__waves"></div>
            </div>
        </a>
        <a class="btn btn-round btn-purple ripple-effect" data-color="purple">
            <div class="paper-ripple">
                <div class="paper-ripple__background"></div>
                <div class="paper-ripple__waves"></div>
            </div>
        </a>
    </div><!-- /.theme-colors -->
    <div class="theme-code ltr text-left">
        <code>&lt;body class="theme-blue fix-headerundefined sidebar-extra"&gt;</code>
    </div><!-- /.theme-code -->
</div>
<!-- END SETTING -->

<!-- BEGIN CODE MODAL -->
<div class="modal fade" id="code-modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn btn-default btn-round btn-icon pull-right" id="btn-copy"><i
                            class="fa fa-copy"></i></button>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">کپی کردن کدها</h4>
            </div>
            <div class="modal-body"></div>
        </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->
<!-- END CODE MODAL -->

<!-- BEGIN JS -->
<script src="{{ env('PUBLIC_PATH') }}/plugins/jquery/dist/jquery-1.12.4.min.js"></script>
<script src="{{ env('PUBLIC_PATH') }}/plugins/jquery-migrate/jquery-migrate-1.2.1.min.js"></script>
<script src="{{ env('PUBLIC_PATH') }}/plugins/popper/popper.min.js"></script>
<script src="{{ env('PUBLIC_PATH') }}/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="{{ env('PUBLIC_PATH') }}/plugins/metisMenu/dist/metisMenu.min.js"></script>
<script src="{{ env('PUBLIC_PATH') }}/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
<script src="{{ env('PUBLIC_PATH') }}/plugins/paper-ripple/dist/PaperRipple.min.js"></script>
<script src="{{ env('PUBLIC_PATH') }}/plugins/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="{{ env('PUBLIC_PATH') }}/plugins/sweetalert2/dist/sweetalert2.min.js"></script>
<script src="{{ env('PUBLIC_PATH') }}/plugins/select2/dist/js/select2.full.min.js"></script>
<script src="{{ env('PUBLIC_PATH') }}/plugins/screenfull/dist/screenfull.min.js"></script>
{{--<script src="{{ env('PUBLIC_PATH') }}/plugins/iCheck/icheck.min.js"></script>--}}
<script src="{{ env('PUBLIC_PATH') }}/plugins/switchery/dist/switchery.js"></script>
<script src="{{ env('PUBLIC_PATH') }}/plugins/persian-datepicker/js/persian-datepicker.min.js"></script>
<script src="{{ env('PUBLIC_PATH') }}/plugins/data-table/js/jquery.dataTables.min.js"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>--}}
<script src="{{ env('PUBLIC_PATH') }}/js/pages/calendar.js"></script>
<script src="{{ env('PUBLIC_PATH') }}/js/pages/datatable.js"></script>
{{--<script src="{{ env('PUBLIC_PATH') }}/js/core.min.js"></script>--}}
<script src="{{ env('PUBLIC_PATH') }}/js/core.js"></script>
<script src="{{ env('PUBLIC_PATH') }}/js/custom.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

</body>
</html>
