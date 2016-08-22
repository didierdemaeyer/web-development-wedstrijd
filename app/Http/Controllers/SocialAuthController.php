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

        auth()->login($data['user']);

        // if the user registered with OAuth
        if ($data['is_new']) {
            // TODO: redirect to settings or an update information page to fill in remaining info
            return redirect()->route('entries.popular')->with('provider', $data['provider'])->with('register_type', 'oauth');
        }

        return redirect()->intended('/');
    }
}
