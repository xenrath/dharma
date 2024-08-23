<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            if (auth()->user()->isDev()) {
                return redirect('dev');
            }
            if (auth()->user()->isOperator()) {
                return redirect('operator');
            }
            if (auth()->user()->isDosen()) {
                return redirect('dosen');
            }
        }

        return redirect('login');
    }

    public function login()
    {
        if (auth()->check()) {
            return redirect('check-user');
        } else {
            return view('login');
        }
    }

    public function login_proses(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username harus diisi!',
            'password.required' => 'Password harus diisi!',
        ]);

        if ($validator->fails()) {
            alert()->error('Error', 'Isi data dengan benar!');
            return back()->withInput()->withErrors($validator);
        }

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect('/');
        } else {
            alert()->error('Error', 'Username atau Password salah!');
            return back()->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('login');
    }

    public function check_user()
    {
        if (auth()->check()) {
            if (auth()->user()->isAdmin()) {
                return redirect('admin');
            }
            if (auth()->user()->role == 'user') {
                return redirect('user');
            }
        }

        return redirect('login');
    }
}
