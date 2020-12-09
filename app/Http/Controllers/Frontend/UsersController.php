<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SoapClient;
use Carbon\Carbon;

class UsersController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            if (Auth::user()->role === 1) {
                return redirect()->route('admin.users');
            } else {
                return redirect()->route('admin.equipmentreports');
            }
        }
        return view('frontend.users.login')->with('panel_title', 'ورود');
    }

    public function registeration()
    {
        if (Auth::check()) {
            if (Auth::user()->role === 1) {
                return redirect()->route('admin.users');
            } else {
                return redirect()->route('frontend.mydevices');
            }
        }
        return view('frontend.users.registeration')->with('panel_title', 'ثبت نام');
    }

    public function dologin(Request $request)
    {
        if ($request->has('g-recaptcha-response')) {
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . env('CAPTCHA_SECRET_KEY') . '&response=' . request('g-recaptcha-response'));
            $responseData = json_decode($verifyResponse);

            if ($responseData->success == FALSE):
                return redirect()->back()->with('danger', 'برای احراز هویت خود دوباره تلاش کنید');
            endif;


            if (!isset($_POST['g-recaptcha-response']) || empty($_POST['g-recaptcha-response'])):
                return redirect()->back()->with('danger', 'لطفا هویت خود را تایید کنید.');
            endif;
        }

        $login_data = ['user_name' => $request->input('user_name'), 'password' => $request->input('password')];
        if (Auth::attempt($login_data)) {
            if (Auth::user()->role === User::ADMIN) {
                return redirect()->route('admin.users');
            }
            return redirect()->route('admin.equipmentreports');
        }
        return redirect()->back()->with('loginError', 'نام کاربری یا رمز عبور اشتباه است.');
    }

    public function doregisteration()
    {
        $this->validate(request(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'user_name' => 'required|min:3',
            'password' => 'min:4|max:12'
        ], [
            'first_name.required' => 'لطفا نام را وارد کنید.',
            'last_name.required' => 'لطفا نام خانوادگی را وارد کنید.',
            'user_name.required' => 'لطفا نام کاربری را وارد کنید.',
            'user_name.min' => 'نام کاربری باید حداقل ۳ کاراکتر باشد.',
            'password.min' => 'رمز عبور باید حداقل ۴ کاراکتر باشد.',
            'password.max' => 'رمز عبور باید حداکثر ۱۲ کاراکتر باشد.'
        ]);

        $user_data = [
            'first_name' => request()->input('first_name'),
            'last_name' => request()->input('last_name'),
            'user_name' => request()->input('user_name'),
            'email' => request()->input('email'),
            'password' => request()->input('password')
        ];

        $register_success = User::create($user_data);

        if ($register_success) {
            return view('frontend.users.login')->with('msg', 'ثبت نام با موفقیت انجام شد. از طریق فرم زیر وارد شوید.');
        }
    }

    public function register()
    {
        $this->validate(request(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'user_name' => 'required|digits:11|unique:users,user_name',
            'password' => 'min:4|max:12',
            'confirm_password' => 'same:password'
        ], [
            'first_name.required' => 'لطفا نام را وارد کنید.',
            'last_name.required' => 'لطفا نام خانوادگی را وارد کنید.',
            'user_name.required' => 'لطفا نام کاربری را وارد کنید.',
            'user_name.unique' => 'این شماره از قبل موجود است.',
            'user_name.digits' => 'شماره وارد شده باید ۱۱ رقمی باشد.',
            'password.min' => 'رمز عبور باید حداقل ۴ کاراکتر باشد.',
            'password.max' => 'رمز عبور باید حداکثر ۱۲ کاراکتر باشد.',
            'confirm_password.same' => 'تایید رمز عبور باید با رمز عبور برابر باشد.'
        ]);


        $user_data = [
            'first_name' => request()->input('first_name'),
            'last_name' => request()->input('last_name'),
            'user_name' => request()->input('user_name'),
            'password' => request()->input('password'),
        ];

        $register_success = User::create($user_data);

        if ($register_success) {
            $new_user_id = $register_success->id;
            return redirect()->route('verification', ['uid' => $new_user_id]);
        }
    }

    public function verification(Request $request, $uid)
    {
        $otp = rand(10000, 99999);
        $user_otp = [
            'otp' => $otp
        ];
        $user_item = User::find($uid);
        $otp_edited = $user_item->update($user_otp);
        $user_name = $user_item->user_name;
        if (is_numeric($user_name) && strlen($user_name) === 11) {
            $user_phone_number = $user_name;
        } else {
            $user_phone_number = $user_item->phone_number;
        }
        if ($user_phone_number !== null && $user_phone_number !== '') {
            if ($otp_edited) {
                // send SMS
                ini_set("soap.wsdl_cache_enabled", "0");
                $sms_client = new SoapClient('http://payamak-service.ir/SendService.svc?wsdl', array('encoding' => 'UTF-8'));
                try {
                    $parameters['userName'] = "c.aref.basiri";
                    $parameters['password'] = "72599";
                    $parameters['fromNumber'] = "10009611";
                    $parameters['toNumbers'] = array($user_phone_number);
                    $parameters['messageContent'] = "کد تایید شما در هوشمند کنترل: " . $otp;
                    $parameters['isFlash'] = false;
                    $recId = array(0);
                    $status = 0x0;
                    $parameters['recId'] = &$recId;
                    $parameters['status'] = &$status;
                    echo $sms_client->SendSMS($parameters)->SendSMSResult;
                } catch (Exception $e) {
                    echo 'Caught exception: ', $e->getMessage(), "\n";
                }
            }
        } else {
            return redirect()->back()->with('danger', 'شماره تلفن شما ثبت نشده است. از اطلاعات حساب کاربری شماره همراه خود را اضافه کنید و دوباره امتحان کنید.');
        }
        return view('frontend.users.verification')->with('msg', 'کد تایید به شماره شما پیامک شد. کد را اینجا وارد کنید.');
    }

    public function doverification(Request $request, $uid)
    {
        $user_item = User::find($uid);
        $user_otp = $user_item->otp;
        $otp = request()->input('otp_code');
        if ($user_otp == $otp) {
            $now_in_timestamp = Carbon::now()->toDateTimeString();
            $update_data = [
                'phone_verified_at' => $now_in_timestamp
            ];
            $user_verified = $user_item->update($update_data);
            if ($user_verified) {
                return redirect()->route('signin')->with('success', 'شماره همراه با موفقیت تایید شد. از اینجا وارد شوید.');
            } else {
                return redirect()->back()->with('danger', 'تایید شماره همراه انجام نشد.');
            }

        } else {
            return redirect()->back()->with('danger', 'کد وارد شده معتبر نمی‌باشد.');
        }

    }

    public function signin()
    {
        if (Auth::check()) {
            if (Auth::user()->role === 1) {
                return redirect()->route('admin.users');
            } else {
                return redirect()->route('frontend.mydevices');
            }
        }
        return view('frontend.users.signin');
    }

    public function dosignin(Request $request)
    {
        if ($request->has('g-recaptcha-response')) {
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . env('CAPTCHA_SECRET_KEY') . '&response=' . request('g-recaptcha-response'));
            $responseData = json_decode($verifyResponse);

            if ($responseData->success == FALSE):
                return redirect()->back()->with('danger', 'برای احراز هویت خود دوباره تلاش کنید');
            endif;


            if (!isset($_POST['g-recaptcha-response']) || empty($_POST['g-recaptcha-response'])):
                return redirect()->back()->with('danger', 'لطفا هویت خود را تایید کنید.');
            endif;
        }
        $login_data = ['user_name' => $request->input('user_name'), 'password' => $request->input('password')];
        if (Auth::attempt($login_data)) {
            if (Auth::user()->role === User::ADMIN) {
                return redirect()->route('admin.users');
            }
            return redirect()->route('frontend.mydevices');
        }
        return redirect()->back()->with('loginError', 'نام کاربری یا رمز عبور اشتباه است.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('signin'));
    }

    public function notverified()
    {
        return view('frontend.users.non_verified_user');
    }
}
