<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Branch;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin/users/users', compact('users'))->with(['panel_title' => 'لیست کاربران', 'make_new' => route('admin.users.create')]);
    }

    public function create()
    {
        return view('admin/users/create')->with('panel_title', 'ثبت کاربر جدید');
    }

    public function store(UserRequest $userRequest) {
        $user_data = [
            'first_name' => request()->input('first_name'),
            'last_name' => request()->input('last_name'),
            'user_name' => request()->input('user_name'),
            'email' => request()->input('email'),
            'password' => request()->input('password'),
            'role' => request()->input('role')
        ];
        $add_user_success = User::create($user_data);

        if ($add_user_success) {
            return redirect()->route('admin.users')->with('success', 'کاربر با موفقیت اضافه شد.');
        }
    }

    public function edit($user_id)
    {
        $userItem = User::find($user_id);
        return view('admin.users.edit', compact('userItem'))->with('panel_title', 'ویرایش اطلاعات کاربر');
    }

    public function doEdit(UserRequest $userRequest, $user_id)
    {
        $user_data = [
            'first_name' => request()->input('first_name'),
            'last_name' => request()->input('last_name'),
            'user_name' => request()->input('user_name'),
            'email' => request()->input('email'),
            'password' => request()->input('password'),
            'role' => request()->input('role')
        ];
//        if (empty(request()->input('password'))) {
//            unset($user_data['password']);
//        }

        $userItem = User::find($user_id);
        $userItem->update($user_data);
        return redirect()->back()->with('success', 'اطلاعات با موفقیت ویرایش شد.');
    }

    public function delete($user_id)
    {
        $userItem = User::find($user_id);
        if ($userItem && $userItem instanceof User) {
            $userItem->delete();
            return redirect()->route('admin.users');
        }
    }
}
