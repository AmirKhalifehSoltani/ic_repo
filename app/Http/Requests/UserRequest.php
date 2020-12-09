<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'user_name' => 'required|min:3',
            'password' => 'min:4|max:12'
        ];

        if (request()->route('user_id') && intval(request()->route('user_id') > 0)){
            unset($rules['password']);
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'first_name.required' => 'لطفا نام را وارد کنید.',
            'last_name.required' => 'لطفا نام خانوادگی را وارد کنید.',
            'user_name.required' => 'لطفا نام کاربری را وارد کنید.',
            'user_name.min' => 'نام کاربری باید حداقل ۳ کاراکتر باشد.',
            'password.min' => 'رمز عبور باید حداقل ۴ کاراکتر باشد.',
            'password.max' => 'رمز عبور باید حداکثر ۱۲ کاراکتر باشد.'
        ];
    }
}
