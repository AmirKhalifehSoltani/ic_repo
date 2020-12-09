@extends('layouts.admin')
@section('content')
    <div class="col-md-6 offset-md-3">
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
        <form id="simple-form" role="form" method="post" action="{{ route('dologin') }}">
            {{ csrf_field() }}
            <div class="form-body">
                <div class="form-group">
                    <label for="user_name">نام کاربری
                        <small> (الزامی)</small>
                    </label>
                    <div class="input-group">
                    <span class="input-group-addon">
                        <i class="icon-user"></i>
                    </span>
                        <input id="user_name" class="form-control" name="user_name" type="text"
                               value="{{ old('user_name') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">رمز عبور
                        <small>(الزامی حداقل 5 کاراکتر)</small>
                    </label>
                    <div class="input-group">
                    <span class="input-group-addon">
                        <i class="icon-key"></i>
                    </span>
                        <input type="password" id="password" minlength="5" class="form-control" name="password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="offset-md-3">
                            <div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_SITE_KEY')}}"></div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="form-actions">
                <button type="submit" class="btn btn-lg btn-info col-md-6 offset-md-3">
                    <i class="icon-check"></i>
                    ورود
                </button>
            </div>
        </form>
    </div>
@endsection
