<?php

namespace App\Http\Controllers;

use App\Country;
use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterFormRequest;
use App\Role;
use App\User;
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

    /**
     * @return mixed
     */
    public function getRegister()
    {
        $countries = Country::orderBy('name')->get();

        return view('auth.register', compact('countries'));
    }

    /**
     * @param RegisterFormRequest $request
     * @return $this
     */
    public function postRegister(RegisterFormRequest $request)
    {
        try {
            $userData = $request->only(
                'email',
                'password',
                'firstname',
                'lastname',
                'address',
                'city',
                'postcode'
            );
            $userData['fullname'] = $request->get('firstname') . ' ' . $request->get('lastname');
            $userData['country_id'] = (int) $request->get('country');

            $user = new User($userData);
            $role = Role::where('name', 'user')->first();
            $user->role()->associate($role);

            $user->save();

            \Auth::login($user);
        } catch (\Exception $e) {
            showErrors(['Something went wrong! Please try again.']);

            return back()->withInput();
        }

        showSuccess(['Thanks for registering.']);

        return redirect()->route('entries.popular');
    }

    /**
     * @return mixed
     */
    public function logout()
    {
        \Auth::logout();

        return redirect()->route('home');
    }
}
