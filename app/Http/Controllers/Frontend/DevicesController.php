<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeviceRequest;
use App\Models\Button;
use App\Models\Device;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\StaticAnalysis\HappyPath\AssertIsArray\consume;

class DevicesController extends Controller
{
    public function list()
    {
        $user = Auth::user();
        $my_devices = $user->devices;
        return view('frontend.devices.list', compact('my_devices'));
    }

    public function single($device_id)
    {
        $device_item = Device::find($device_id);
        $device_btns = $device_item->buttons;
        return view('frontend.devices.single', compact('device_btns'));
    }

    // ----------------
    public function sendcmd(Request $request)
    {
        $btnId = $request->btnId;
        $switchCmd = $request->switchCmd;
        $btnItem = Button::find($btnId);
        $update_data = [
            'cmd' => $switchCmd
        ];
        $btn_cmd_updated = $btnItem->update($update_data);
        if ($btn_cmd_updated) {
            return [
                'success' => true
            ];
        } else {
            return [
                'success' => false
            ];
        }
    }

    public function getstatus(Request $request)
    {
        $btn_id = $request->btnId;
        $btn_item = Button::find($btn_id);
        if ($btn_item && $btn_item instanceof Button) {
            $btn_status = $btn_item->status;
            return [
                'success' => true,
                'status' => $btn_status
            ];
        } else {
            return [
                'success' => false
                ];
        }
    }

    // ----------------
    public function index()
    {
        $current_user_id = Auth::user()->id;
        $devices = Device::get()->where('device_creator_user_id', $current_user_id);
        return view('frontend/devices/devices', compact('devices'))->with(['panel_title' => 'لیست دستگاه‌های من', 'make_new' => route('frontend.devices.create')]);
    }

    public function create()
    {
//        $users = User::all();
        return view('frontend/devices/create')->with('panel_title', 'ثبت دستگاه جدید');
    }

    public function store(DeviceRequest $deviceRequest) {
        $code = request()->input('device_code');
        $formatted_code = '++'.$code.'--';
        $token = md5($formatted_code);
        $current_user_id = Auth::user()->id;
        $device_data = [
            'name' => request()->input('device_name'),
            'code' => $code,
            'token' => $token,
            'device_creator_user_id' => $current_user_id
        ];
        $add_device_success = Device::create($device_data);

        if ($add_device_success) {
            $device_user_ids = [$current_user_id];
            $users_phone_numbers = [
                $deviceRequest->input('user2'),
                $deviceRequest->input('user3'),
                $deviceRequest->input('user4'),
                $deviceRequest->input('user5')
            ];
            foreach ($users_phone_numbers as $users_phone_number) {
                if ($users_phone_numbers && $users_phone_number != '') {
                    $user_item_by_phone_number = User::where('phone_number', $users_phone_number)->first();
                    $user_id_by_phone_number = $user_item_by_phone_number->id;
                    $device_user_ids[] = $user_id_by_phone_number;
                }
            }

            $device_item = Device::find($add_device_success->id);
            $device_item->users()->sync($device_user_ids);
            return redirect()->route('frontend.devices')->with('success', 'دستگاه با موفقیت اضافه شد.');
        }
    }

    public function edit($device_id)
    {
        $users = User::all();
        $deviceItem = Device::find($device_id);
        $device_creator_user_id = $deviceItem->device_creator_user_id;
        $owner_user_item = User::find($device_creator_user_id);
        $owner_user_phone_number = $owner_user_item->phone_number;
        $device_users = $deviceItem->users()->get();
        $device_user_phone_numbers = [];
        foreach($device_users as $device_user){
            if ($device_user->phone_number == $owner_user_phone_number) {
                continue;
            }
            $device_user_phone_numbers[] = $device_user->phone_number;
        }
//        unset($device_user_phone_numbers[0]);   // omit phone_number of user 1
//        dd($device_user_phone_numbers);
        return view('frontend.devices.edit', compact('deviceItem', 'users', 'device_user_phone_numbers'))->with('panel_title', 'ویرایش اطلاعات دستگاه');
    }

    public function doEdit(DeviceRequest $deviceRequest, $device_id)
    {
        $code = request()->input('device_code');
        $formatted_code = '++'.$code.'--';
//        $token = md5($formatted_code);
        $device_data = [
            'name' => request()->input('device_name'),
//            'code' => $code,
//            'token' => $token
        ];

        $deviceItem = Device::find($device_id);
        $device_updated = $deviceItem->update($device_data);
        if ($device_updated) {
            $device_user_ids = [$deviceItem->device_creator_user_id];
            $users_phone_numbers = [
                $deviceRequest->input('user2'),
                $deviceRequest->input('user3'),
                $deviceRequest->input('user4'),
                $deviceRequest->input('user5')
            ];
//            dd($users_phone_numbers);
            foreach ($users_phone_numbers as $users_phone_number) {
                if ($users_phone_numbers && $users_phone_number != '') {
                    $user_item_by_phone_number = User::where('phone_number', $users_phone_number)->first();
                    $user_id_by_phone_number = $user_item_by_phone_number->id;
                    $device_user_ids[] = $user_id_by_phone_number;
                }
            }
//            dd($device_user_ids);
            $deviceItem->users()->sync($device_user_ids);

            return redirect()->back()->with('success', 'اطلاعات با موفقیت ویرایش شد.');
        }
    }

    public function delete($device_id)
    {
        $deviceItem = Device::find($device_id);
        if ($deviceItem && $deviceItem instanceof Device) {
            $deviceItem->delete();
            return redirect()->route('frontend.devices');
        }
    }
}
