<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Mail\NewUserNotification;
use App\User;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class icUsersController extends Controller
{
    public function sendEmail(Request $request)
    {
        $validator = Validator::make(
            [
                'email' => $request->email
            ],
            [
                'email' => 'required|email|unique:users,email',
            ]
        );

        if ($validator->fails()) {
            $messages = $validator->errors();
            return response()->json(['message' => $messages->first('email')]);
        }

        $code_generated = rand(100000, 999999);

        $new_user_data = [
            'email' => $request->email,
            'icvcode' => $code_generated
        ];
        if ($new_user_data) {
            $reg_success = User::create($new_user_data);
            if ($reg_success) {
                Mail::to($reg_success)->send(new NewUserNotification($reg_success));
                return response()->json(['message' => 'Verification code sent to your email', 'status_code' => 200]);
            }
            return response()->json(['message' => 'Add email failed!']);
        }
        return response()->json(['message' => 'Operation failed!']);
    }

    public function verifyCode(Request $request)
    {
        $validator = Validator::make(
            [
                'email' => $request->email,
                'code' => $request->code
            ],
            [
                'email' => 'required|email|exists:users,email',
                'code' => 'required',
            ]
        );

        if ($validator->fails()) {
            $messages = $validator->errors();
            $fields = ['email', 'code'];
            $alert = [];
            foreach ($fields as $field) {
                if ($messages->first($field) != '') {
                    $alert[] = $messages->first($field);
                }
            }
            return response()->json($alert);
        }

        if ($request->email && $request->code) {
            $user_data = ['email_verified_at' => Carbon::now(), 'icvcode' => null];
            $userItem = User::where('email', $request->email)->first();
            $userCode = $userItem->icvcode;
            if ($userCode == $request->code) {
                $user_verified = $userItem->update($user_data);
                if ($user_verified) {
                    return response()->json(['message' => 'Your account has been verified successfully!', 'status_code' => 200]);
                } else {
                    return response()->json(['message' => 'Verification failed!']);
                }
            }
            return response()->json(['message' => 'incorrect verification code!']);
        }
    }

    public function addMoreInfo(Request $request)
    {
        $validator = Validator::make(
            [
                'email' => $request->email,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'password' => $request->password
            ],
            [
                'email' => 'required|email|exists:users,email',
                'first_name' => 'required',
                'last_name' => 'required',
                'password' => 'required',
            ]
        );

        if ($validator->fails()) {
            $messages = $validator->errors();
            $fields = ['email', 'first_name', 'last_name', 'password'];
            $alert = [];
            foreach ($fields as $field) {
                if ($messages->first($field) != '') {
                    $alert[] = $messages->first($field);
                }
            }
            return response()->json($alert);
        }

        $email = $request->email;
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $password = $request->password;

        if ($email && $first_name && $last_name && $password) {
            $user_data = [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'password' => $password,
            ];
            $userItem = User::where('email', $request->email)->first();
            $user_info_updated = $userItem->update($user_data);
            if ($user_info_updated) {
                return response()->json(['message' => 'Your account info updated successfully!', 'status_code' => 200]);
            }
        }
        return response()->json(['message' => 'Invalid Request!', 'status_code' => 400]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make(
            [
                'email' => $request->email,
                'password' => $request->password
            ],
            [
                'email' => 'required|email|exists:users,email',
                'password' => 'required',
            ]
        );

        if ($validator->fails()) {
            $messages = $validator->errors();
            $fields = ['email', 'password'];
            $alert = [];
            foreach ($fields as $field) {
                if ($messages->first($field) != '') {
                    $alert[] = $messages->first($field);
                }
            }
            return response()->json($alert);
        }

        $login_data = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if ($login_data) {
            $login_success = Auth::attempt($login_data);
            if ($login_success)
                return response()->json(Auth::user());
        }
        return response()->json(['message' => 'Login was not successful']);
    }

    public function forgetPasswordRequest(Request $request)
    {
        $validator = Validator::make(
            [
                'email' => $request->email
            ],
            [
                'email' => 'required|email|exists:users,email'
            ]
        );
        $alert = [];
        if ($validator->fails()) {
            $messages = $validator->errors();
            $alert[] = $messages->first('email');
            return response()->json($alert);
        }

        $email = $request->email;

        $user_item = User::where('email', $email)->first();
        $user_verified_at = $user_item->email_verified_at;
        // if user is verified (active)
        if ($user_verified_at && $user_verified_at instanceof Carbon) {
            $code_generated = rand(100000, 999999);
            $user_data = ['icvcode' => $code_generated];
            $code_stored = $user_item->update($user_data);
            if ($code_stored) {
                // send email
                Mail::to($user_item)->send(new NewUserNotification($user_item));
                return response()->json(['message' => 'Successful forget password request!', 'status_code' => 200]);
            }
        }
        return response()->json(['message' => 'This user is not active', 'status_code' => 401]);
    }

    public function forgetPasswordVerification(Request $request)
    {
        $validator = Validator::make(
            [
                'email' => $request->email,
                'code' => $request->code,
                'password' => $request->password
            ],
            [
                'email' => 'required|email|exists:users,email',
                'code' => 'required',
                'password' => 'required'
            ]
        );

        if ($validator->fails()) {
            $messages = $validator->errors();
            $fields = ['email', 'code', 'password'];
            $alert = [];
            foreach ($fields as $field) {
                if ($messages->first($field) != '') {
                    $alert[] = $messages->first($field);
                }
            }
            return response()->json($alert);
        }

        $email = $request->email;
        $code = $request->code;
        $password = $request->password;

        $user_data = ['password' => $password, 'icvcode' => null];
        $userItem = User::where('email', $email)->first();
        $userCode = $userItem->icvcode;
        if ($userCode == $code) {
            $user_updated = $userItem->update($user_data);
            if ($user_updated) {
                return response()->json(['message' => 'Password changed successfully!', 'status_code' => 200]);
            } else {
                return response()->json(['message' => 'Password did not changed!']);
            }
        }
        return response()->json(['message' => 'Verification code is not correct', 'status_code' => 401]);
    }
}
