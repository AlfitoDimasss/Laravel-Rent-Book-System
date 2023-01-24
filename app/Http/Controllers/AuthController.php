<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function authenticating(Request $req)
    {
        $credential = $req->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credential)) {
            if (Auth::user()->status != 'active') {
                Auth::logout();
                $req->session()->invalidate();
                $req->session()->regenerateToken();
                return redirect('/login')->with(['status' => 'Account not actived yet.']);
            }

            $req->session()->regenerate();

            if (Auth::user()->role_id == 1) {
                return redirect('/dashboard');
            }

            return redirect('/profile');
        }

        return redirect('/login')->with(['status' => 'Invalid Account!']);
    }

    public function logout(Request $req)
    {
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect('/login');
    }

    public function registerProcess(Request $req)
    {
        $req->validate([
            'username' => 'unique:users'
        ]);

        $req['password'] = Hash::make($req->password);
        $res = User::create($req->all());
        if ($res) {
            return redirect('/login')->with(['success' => 'Registration is successful, please wait until admin approve your account.']);
        } else {
            return redirect('/login')->with(['success' => 'Registration is unsuccessfuly, please try again.']);
        }
    }
}
