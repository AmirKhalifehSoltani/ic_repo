@extends('layouts.auth')
@section('content')
    <h2 class="text-center m-b-20">وارد شوید</h2>
    <hr>
    @if(session('loginError'))
        <div class="alert alert-info">
            <p>{{ session('loginError') }}</p>
        </div>
    @endif
    @if(isset($msg))
        <div class="alert alert-info">
            <p>{{ $msg }}</p>
        </div>
    @endif
    <form id="form" class="m-t-30 m-b-30" action="{{ route('dosignin') }}" method="POST" role="form">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="user_name">نام کاربری</label>
            <div class="input-group">
                    <span class="input-group-addon">
                        <i class="icon-user"></i>
                    </span>
                <input id="user_name" class="form-control ltr text-left" type="user_name" name="user_name" required>
            </div><!-- /.input-group -->
        </div><!-- /.form-group -->
        <div class="form-group">
            <label for="password">رمز عبور</label>
            <div class="input-group">
                    <span class="input-group-addon">
                        <i class="icon-key"></i>
                    </span>
                <input id="password" class="form-control ltr text-left" name="password" type="password" minlength="5" required>
            </div><!-- /.input-group -->
        </div><!-- /.form-group -->
        <div class="form-group">
            <div class="input-group">
                <div>
                    <div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_SITE_KEY')}}"></div>
                </div>
            </div>
        </div>
        <p>
            <button class="btn btn-info btn-block" type="submit">
                <i class="icon-login"></i>
                ورود
            </button>
        </p>
        <div>
            <p>
                حساب کاربری ندارید؟
                <a href="{{ route('registeration') }}">ثبت نام کنید</a>
            </p>
        </div>
    </form>
@endsection