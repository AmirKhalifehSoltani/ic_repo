@extends('layouts.admin')
@section('content')
    <div class="row">
        @if($device_btns && count($device_btns) > 0)
            @foreach($device_btns as $device_btn)
                <div class="card_wrap col-md-4 col-sm-12">
                    <div class="row card_content_row">
                        <div class="col-8">
                            {{ isset($device_btn->name)? $device_btn->name: '' }}
                        </div>
                        <div class="col-4">
                            <input type="checkbox" id="switchId-{{ isset($device_btn->id)? $device_btn->id: ''  }}"
                                   class="js-switch" {{ isset($device_btn->status) && $device_btn->status == 1 ? 'checked': '' }} />
                            {{--<input type="checkbox" class="ios_checkbox" id="{{ isset($device_btn->status)? $device_btn->status: '' }}" name="name" checked>--}}
                            {{--<label class="ios-checkbox" for="{{ isset($device_btn->status)? $device_btn->status: '' }}" data-permit="" data-deny=""></label>--}}
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <div class="alert alert-info">
                    دکمه‌ای برای این دستگاه تنظیم نشده است.
                </div>
            </div>
        @endif
    </div>
@endsection