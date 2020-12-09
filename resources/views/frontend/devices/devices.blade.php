@extends('layouts.admin')
@section('content')
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped" id="admin_devices_table">
            <thead>
            <tr>
                <th>نام دستگاه</th>
                <th>کد دستگاه</th>
                <td>عملیات</td>
            </tr>
            </thead>
            <tbody>
            @if($devices && count($devices) > 0)
                @include('frontend.devices.row', $devices)
            @else
                <tr>
                    <td colspan="3" style="text-align: center">دستگاهی وجود ندارد!</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
@endsection
