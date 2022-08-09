<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::guest())
            return view('auth.login');
        return redirect()->route('home');
    }

    public function postLogin(LoginRequest $request)
    {

        $credencias = $request->only('nome', 'password');
        if (Auth::attempt($credencias, true) || Auth::attempt(['email' => $request->nome, 'password' => $request->password], true)) {
            return redirect()->route('home');
        }
        return redirect()->back()->withInput(['smg' => 'Credenciais invalido!...']);
    }

    public function logOut()
    {
        if (Auth::check())
            Auth::logout();
        return redirect()->route('login');
    }
}
