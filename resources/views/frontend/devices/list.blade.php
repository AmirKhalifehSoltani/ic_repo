@extends('layouts.admin')
@section('content')
    <div class="row">
        @if($my_devices && count($my_devices) > 0)
            @foreach($my_devices as $my_device)
                <div class="card_wrap col-md-4 col-sm-12">
                    <div class="row card_content_row">
                        <a class="card_wrap" href="{{ route('frontend.mysingledevice', $my_device->id) }}">
                            <div class="col-8 pull-right">
                                {{ isset($my_device->name)? $my_device->name: '' }}
                            </div>
                            <div class="col-4 pull-left">
                                {{ isset($my_device->temp)? $my_device->temp: '' }}
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <div class="alert alert-info">
                    دستگاهی برای حساب کاربری شما تنظیم نشده است.
                </div>
            </div>
        @endif
    </div>
@endsection