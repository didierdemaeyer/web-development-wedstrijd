<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSettingsFormRequest;
use App\Http\Requests;

class SettingsController extends Controller
{
    /**
     * @return mixed
     */
    public function getSettings()
    {
        $user = \Auth::user();

        if (count($user->photos)) {
            $required_info = 'full';
        } else {
            $required_info = 'default';
        }
        session()->put('required_info', $required_info);

        return view('profile.settings');
    }

    /**
     * @param UpdateSettingsFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postSettings(UpdateSettingsFormRequest $request)
    {
        try {
            $user = \Auth::user();
            $userData = $request->only(
                'firstname',
                'lastname',
                'email',
                'address',
                'city',
                'postcode',
                'country'
            );
            $userData['fullname'] = $request->get('firstname') . ' ' . $request->get('lastname');
            $user->update($userData);
        } catch (\Exception $e) {
            showErrors(['Something went wrong saving your settings! Please try again.']);

            return back()->withInput();
        }

        showSuccess(['Your settings have been updated.']);

        return redirect()->route('home');
    }
}
