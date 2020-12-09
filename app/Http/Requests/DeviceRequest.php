<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeviceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules =  [
            'device_name' => 'required',
            'device_code' => 'required|numeric|unique:devices,code',
            'device_user' => 'not_in:0',
            'user2' => 'sometimes|nullable|exists:users,phone_number',
            'user3' => 'sometimes|nullable|exists:users,phone_number',
            'user4' => 'sometimes|nullable|exists:users,phone_number',
            'user5' => 'sometimes|nullable|exists:users,phone_number'
        ];

        if (request()->route('device_id') && intval(request()->route('device_id') > 0)){
            unset($rules['device_code']);
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'device_name.required' => 'لطفا نام دستگاه را وارد کنید.',
            'device_code.required' => 'لطفا کد دستگاه را وارد کنید.',
            'device_code.numeric' => 'کد دستگاه باید عدد باشد و با کیبورد انگلیسی وارد شود.',
            'device_code.unique' => 'این کد قبلا وارد شده است.',
            'device_user.not_in' => 'لطفا کاربر دستگاه را انتخاب کنید.',
            'user2.exists' => 'کاربری با شماره تلفن کاربر۲ وجود ندارد.',
            'user3.exists' => 'کاربری با شماره تلفن کاربر۳ وجود ندارد.',
            'user4.exists' => 'کاربری با شماره تلفن کاربر۴ وجود ندارد.',
            'user5.exists' => 'کاربری با شماره تلفن کاربر۵ وجود ندارد.',
        ];
    }
}
