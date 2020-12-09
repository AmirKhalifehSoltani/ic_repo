<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeviceRequest;
use App\Models\Device;
use App\User;
use Illuminate\Http\Request;

class DevicesController extends Controller
{
    public function index()
    {
        $devices = Device::all();
        return view('admin/devices/devices', compact('devices'))->with(['panel_title' => 'لیست دستگاه‌ها', 'make_new' => route('admin.devices.create')]);
    }

    public function create()
    {
        $users = User::all();
        return view('admin/devices/create', compact('users'))->with('panel_title', 'ثبت دستگاه جدید');
    }

    public function store(DeviceRequest $deviceRequest) {
        $code = request()->input('device_code');
        $formatted_code = '++'.$code.'--';
        $token = md5($formatted_code);
        $device_user_id = request()->input('device_user');
        $device_data = [
            'name' => request()->input('device_name'),
            'code' => $code,
            'token' => $token,
            'device_user_id' => $device_user_id
        ];
        $add_device_success = Device::create($device_data);

        if ($add_device_success) {
            return redirect()->route('admin.devices')->with('success', 'کاربر با موفقیت اضافه شد.');
        }
    }

    public function edit($device_id)
    {
        $users = User::all();
        $deviceItem = Device::find($device_id);
        return view('admin.devices.edit', compact('deviceItem', 'users'))->with('panel_title', 'ویرایش اطلاعات کاربر');
    }

    public function doEdit(DeviceRequest $deviceRequest, $device_id)
    {
        $code = request()->input('device_code');
        $formatted_code = '++'.$code.'--';
//        $token = md5($formatted_code);
        $device_user_id = request()->input('device_user');
        $device_data = [
            'name' => request()->input('device_name'),
//            'code' => $code,
//            'token' => $token
            'device_user_id' => $device_user_id
        ];

        $deviceItem = Device::find($device_id);
        $deviceItem->update($device_data);
        return redirect()->back()->with('success', 'اطلاعات با موفقیت ویرایش شد.');
    }

    public function delete($device_id)
    {
        $deviceItem = Device::find($device_id);
        if ($deviceItem && $deviceItem instanceof Device) {
            $deviceItem->delete();
            return redirect()->route('admin.devices');
        }
    }
}
