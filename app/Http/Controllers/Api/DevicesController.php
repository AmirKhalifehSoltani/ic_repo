<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Button;
use App\Models\Device;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DevicesController extends Controller
{
//    public function getunix()
//    {
//        $prefix = 'web:';
//        $break = "\r\n";
//        $unix = $prefix.Carbon::now()->unix().$break;
//        return $unix;
//    }

    public function authunix(Request $request)
    {
        if ($request->has('id') && $request->has('token')) {
            $code = $request->input('id');
            $token = $request->input('token');
            $device_item = Device::where('code', $code)->first();
            if ($device_item && $device_item->token == $token) {
                $prefix = 'unix:';
                $break = "\r\n";
                $unix = $prefix . Carbon::now()->unix() . $break;
                return $unix;
            } else {
                return "Access Forbidden!";
            }
        } else {
            return "Incorrect Request";
        }
    }

//    public function gettemp(Request $request)
//    {
//        if ($request->has('ID') && $request->has('token')) {
//            $device_item = Device::where('device_id', $request->input('ID'))->first();
//            if ($device_item) {
//                if ($device_item->token == $request->input('token')) {
//                    $prefix = 'web:';
//                    $break = "\r\n";
//                    return $prefix . $device_item->temp . $break;
//                } else {
//                    return 'Access Forbidden!';
//                }
//            } else {
//                return 'Unknown Device';
//            }
//        }
//    }

    public function settempgetcommand(Request $request)
    {
        if ($request->has('id') && $request->has('token') && $request->has('temp')) {
            $code = $request->input('id');
            $token = $request->input('token');
            $device_item = Device::where('code', $code)->first();
            if (!$device_item || $device_item->token != $token){
                return "Invalid Request!\r\n";
            }

//            $data = [
//                'code' => $request->input('id'),
//                'token' => $request->input('token'),
//                'temp' => $request->input('temp'),
//            ];
            $update_data = [
                'temp' => $request->input('temp'),
            ];

//            $device_codes = Device::pluck('code')->toArray();
//            if (in_array($request->input('id'), $device_codes)) {
//            $device_item = Device::where('code', $request->input('id'))->first();
            if ($device_item instanceof Device) {
                $device_updated = $device_item->update($update_data);
                // return device status
                $device_btns = $device_item->buttons;
                if ($device_btns  && count($device_btns) > 0) {
                    $device_cmd_message = '';
                    foreach ($device_btns as $device_btn) {
                        if ($device_btn->cmd !== null) {
                            $device_btn_cmd = $device_btn->id . ':' . $device_btn->cmd;
                            $device_cmd_message .= $device_btn_cmd."\r\n";
                        }
                    }
                    return "Temp updated!\r\n".$device_cmd_message;
                } else {
                    return "Temp updated!";
                }
            } else {
                return 'Invalid Device!';
            }
        } else {
            return "Invalid Request!";
        }
    }

    public function commandresponse(Request $request)
    {
        if ($request->has('id') && $request->has('token') && $request->has('buttonId') && $request->has('status')) {
            $code = $request->input('id');
            $token = $request->input('token');
            $device_item = Device::where('code', $code)->first();
            if (!$device_item || $device_item->token != $token) {
                return "Invalid Request!\r\n";
            }

            // start foreach buttonId
            $btn_id = $request->input('buttonId');
            $status = $request->input('status');
            $btn_item = Button::find($btn_id);
            if ($btn_item && $btn_item instanceof Button && $status == 200) {
                $btn_cmd = $btn_item->cmd;
                $btn_update_status = [
                  'status' => $btn_cmd,
                  'cmd' => null
                ];
                $updated_status = $btn_item->update($btn_update_status);
                if ($updated_status) {
                    return 'status updated!';
                }
            }
            // end foreach buttonId


        } else {
            return "Invalid Request!";
        }
    }

    public function getbtn(Request $request)
    {
        if ($request->has('id') && $request->has('token') && $request->has('buttonId')) {
            $code = $request->input('id');
            $token = $request->input('token');
            $buttonId = $request->input('buttonId');
            $device_item = Device::where('code', $code)->first();
            if ($device_item && $device_item->token == $token) {
                $btn_item = Button::select('data')->where('id', $buttonId)->first();
                return 'btnData:'.$btn_item->data."\r\n";
            } else {
                return "Access Forbidden!";
            }
        } else {
            return "Incorrect Request";
        }
    }

    public function setbtn(Request $request)
    {
        if ($request->has('id') && $request->has('token') && $request->has('buttonName') && $request->has('buttonData')) {
            $code = $request->input('id');
            $token = $request->input('token');
            $device_item = Device::where('code', $code)->first();
            if (!$device_item || $device_item->token != $token){
                return "Invalid Request!\r\n";
            }
            $data = [
                'device_id' => $request->input('id'),
                'name' => $request->input('buttonName'),
                'data' => $request->input('buttonData'),
            ];

            if ($request->has('buttonId')) {
                $update_data = [
                    'name' => $request->input('buttonName'),
                    'data' => $request->input('buttonData')
                ];

                $buttonId = $request->input('buttonId');
                $btn_item = Button::find($buttonId);
                if ($btn_item) {
                    $btn_updated = $btn_item->update($update_data);
                    return "status:btn updated!\r\n";
                } else {
                    return "Incorrect btnId!\r\n";
                }
            } else {
                $btn_added = Button::create($data);
                if ($btn_added) {
                    return 'newBtnId:' . $btn_added->id . "\r\n";
                } else {
                    return "Operation Failed!\r\n";
                }
            }
        } else {
            return "Incorrect Request!\r\n";
        }
    }

    public function deletebtn(Request $request)
    {
        if ($request->has('id') && $request->has('token') && $request->has('buttonId')) {
            $code = $request->input('id');
            $token = $request->input('token');
            $device_item = Device::where('code', $code)->first();
            if (!$device_item || $device_item->token != $token){
                return 'Invalid Request!';
            }

            $buttonId = $request->input('buttonId');
            $btn_item = Button::find($buttonId);
            if ($btn_item) {
                $btn_deleted = $btn_item->delete();
                if ($btn_deleted) {
                    return 'btn_deleted!';
                } else {
                    return 'Operation Failed!';
                }
            } else {
                return 'Incorrect button_id';
            }
        } else {
            return 'Incorrect Request!';
        }
    }
}
