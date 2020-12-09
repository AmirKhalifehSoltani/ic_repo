@extends('layouts.auth')
@section('content')
        {{--@include('frontend.partials')--}}
        <h2 class="text-center m-b-20">تایید ثبت نام</h2>
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
        <form id="otp_form" role="form" method="post">
            {{ csrf_field() }}
            <div class="form-body">
                <div class="form-group">
                    <label for="otp_code">کد تایید <small> (الزامی)</small></label>
                    <div class="input-group">
                    <span class="input-group-addon">
                        <i class="icon-user"></i>
                    </span>
                        <input id="otp_code" class="form-control" name="otp_code" type="text" value="{{ old('otp_code') }}">
                    </div>
                </div>
            </div>
            <hr>
            <div class="form-actions">
                <button type="submit" class="btn btn-lg btn-success col-md-6 offset-md-3">
                    <i class="icon-check"></i>
                    تایید
                </button>
            </div>
        </form>
@endsection
