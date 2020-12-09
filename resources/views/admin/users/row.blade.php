@foreach($users as $user)
    <tr>
        <td>{{$user->first_name}}</td>
        <td>{{$user->last_name}}</td>
        <td>{{$user->user_name}}</td>
        <td>{{$user->role === 1 ? 'مدیر' : 'کاربر' }}</td>
        <td>{{$user->email}}</td>
        <td>@include('admin.users.operations', $user)</td>
    </tr>
@endforeach
