@extends('layouts.auth')
@section('content')
        {{--@include('frontend.partials')--}}
        <h2 class="text-center m-b-20">ثبت نام</h2>
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
        <form id="registeration_form" role="form" method="post">
            {{ csrf_field() }}
            <div class="form-body">
                <div class="form-group">
                    <label for="first_name">نام <small> (الزامی)</small></label>
                    <div class="input-group">
                    <span class="input-group-addon">
                        <i class="icon-user"></i>
                    </span>
                        <input id="first_name" class="form-control" name="first_name" type="text" value="{{ old('first_name') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="last_name">نام خانوادگی <small> (الزامی)</small></label>
                    <div class="input-group">
                    <span class="input-group-addon">
                        <i class="icon-user"></i>
                    </span>
                        <input id="last_name" class="form-control" name="last_name" type="text" value="{{ old('last_name') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="user_name">شماره تلفن همراه <small> (الزامی)</small></label>
                    <div class="input-group">
                    <span class="input-group-addon">
                        <i class="icon-user"></i>
                    </span>
                        <input id="user_name" class="form-control" name="user_name" type="text" value="{{ old('user_name') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">رمز عبور<small> (الزامی، حداقل ۴ و حداکثر ۱۲ کارکتر) </small></label>
                    <div class="input-group">
                    <span class="input-group-addon">
                        <i class="icon-key"></i>
                    </span>
                        <input type="password" id="password" minlength="5" class="form-control" name="password">
                    </div>
                </div>
                <div class="form-group">
                    <label for="confirm_password">تایید رمز عبور<small> (الزامی، حداقل ۴ و حداکثر ۱۲ کارکتر) </small></label>
                    <div class="input-group">
                    <span class="input-group-addon">
                        <i class="icon-key"></i>
                    </span>
                        <input type="password" id="confirm_password" minlength="5" class="form-control" name="confirm_password">
                    </div>
                </div>
            </div>
            <hr>
            <div class="form-actions">
                <button type="submit" class="btn btn-lg btn-success col-md-6 offset-md-3">
                    <i class="icon-check"></i>
                    ثبت نام
                </button>
            </div>
            <div>
                <p>
                    حساب کاربری دارید؟
                    <a href="{{ route('signin') }}">وارد شوید</a>
                </p>
            </div>
        </form>
@endsection
