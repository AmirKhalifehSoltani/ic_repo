@extends('layouts.admin')
@section('content')
    <h2>حساب کاربری شما تایید نشده است. برای استفاده از امکانات نرم افزار باید حساب خود را تایید کنید.
        <a href="{{ route('verification', \Illuminate\Support\Facades\Auth::user()->id) }}" class="btn btn-success">تایید حساب کاربری</a>
    </h2>
@endsection