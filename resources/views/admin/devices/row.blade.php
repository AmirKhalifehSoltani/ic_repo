@foreach($devices as $device)
    <tr>
        <td>{{$device->name}}</td>
        <td>{{$device->code}}</td>
        <?php $user = $device->user ?>
        <td>{{isset($user)? $user->first_name.' '.$user->last_name.' ( '.$user->user_name.' )': ''}}</td>
        <td>@include('admin.devices.operations', $device)</td>
    </tr>
@endforeach
