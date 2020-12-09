@extends('layouts.admin')
@section('content')
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped" id="admin_users_table">
            <thead>
            <tr>
                <th>نام</th>
                <th>نام خانوادگی</th>
                <th>نام کاربری</th>
                <th>نقش</th>
                <th>ایمیل</th>
                <td>عملیات</td>
            </tr>
            </thead>
            <tbody>
            @if($users && count($users) > 0)
                @include('admin.users.row', $users)
            @endif
            </tbody>
        </table>
    </div>
@endsection
