<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }
    public function login(Request $request)
    {
        $user = [
            'username' => $request->username,
            'password' => $request->password,
        ];
        if (!Auth::attempt($user)) {
            return redirect()->route('login')->with('login-error', 'Tài khoản hoặc mật khẩu không đúng!');
        } else {
            return redirect()->route('news.list');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
