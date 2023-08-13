<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function index()
    {
        $title = 'Login';

        return view('login',compact('title'));
    }

    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        if (auth()->attempt(['username' => $username, 'password' => $password, 'status_delete' => 0],true)) {
            if (auth()->user()->level_user == 1) {
                return redirect('/admin/dashboard');
            }
            else if (auth()->user()->level_user == 0){
                return redirect('/karyawan/dashboard');
            }
        }
        else {
            return redirect('/')->with('log','Gagal Login');
        }
    }

    public function logout()
    {
        auth()->logout();

        return redirect('/');
    }
}
