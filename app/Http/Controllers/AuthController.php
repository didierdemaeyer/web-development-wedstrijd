<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use Illuminate\Http\Request;
use App\Http\Requests;

class AuthController extends Controller
{
    /**
     * @return mixed
     */
    public function getLogin()
    {
        return view('auth.login');
    }

    /**
     * @param LoginFormRequest $request
     * @return $this
     */
    public function postLogin(LoginFormRequest $request)
    {
        if (\Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')], true)) {
            return redirect()->intended('/');
        }

        return redirect()->back()->withInput();
    }

    public function getRegister()
    {
        dd('not implemented yet!');
    }

    public function postRegister(Request $request)
    {
        dd('not implemented yet!');
    }

    public function logout()
    {
        \Auth::logout();

        return redirect()->route('home');
    }
}
