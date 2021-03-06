<?php

namespace App\Http\Controllers;

use App\SocialAccountService;
use Illuminate\Http\Request;
use App\Http\Requests;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    /**
     * Redirect to the social OAuth login from $provider
     *
     * @param $provider
     * @return mixed
     */
    public function redirect($provider)
    {
        $providerKey = \Config::get('services.' . $provider);
        if(empty($providerKey))
            return view('pages.status')
                ->with('error','No such provider');

        return Socialite::driver($provider)->redirect();
    }

    /**
     * Callback function after the user has logged in to OAuth
     *
     * @param $provider
     * @param SocialAccountService $service
     * @return mixed
     */
    public function callback($provider, SocialAccountService $service)
    {
        $data = $service->createOrGetUser(Socialite::driver($provider));

        if (isset($data['type'])) {
            if ($data['type'] === 'access_denied') {
                showErrors(['Account access denied. Please accept the information request.']);
            } elseif ($data['type'] === 'user_disqualified') {
                showErrors(['Your account has been disqualified. Please contact the administrator for further information.']);
            }
            return redirect()->route('auth.login');
        }

        auth()->login($data['user']);

        // if the user registered with OAuth
        if ($data['is_new']) {
            showSuccess(['Thanks for registering. You can now like and upload photos.']);

            return redirect()->route('home')->with('provider', $data['provider'])->with('register_type', 'oauth');
        }

        return redirect()->intended('/');
    }
}
