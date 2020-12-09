@foreach($devices as $device)
    <tr>
        <td>{{$device->name}}</td>
        <td>{{$device->code}}</td>
        <td>@include('frontend.devices.operations', $device)</td>
    </tr>
@endforeach
