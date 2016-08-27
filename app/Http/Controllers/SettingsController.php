<?php

namespace App\Http\Controllers;

use App\Country;
use App\Http\Requests\ChangePasswordFormRequest;
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
        $countries = Country::orderBy('name')->get();

        if (count($user->photos)) {
            $required_info = 'full';
        } else {
            $required_info = 'default';
        }
        session()->put('required_info', $required_info);

        return view('profile.settings', compact('countries'));
    }

    /**
     * @param UpdateSettingsFormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePersonalInformation(UpdateSettingsFormRequest $request)
    {
        try {
            $user = \Auth::user();
            $userData = $request->only(
                'firstname',
                'lastname',
                'email',
                'address',
                'city',
                'postcode'
            );
            $userData['fullname'] = $request->get('firstname') . ' ' . $request->get('lastname');
            $userData['country_id'] = (int) $request->get('country');
            $user->update($userData);
        } catch (\Exception $e) {
            showErrors(['Something went wrong saving your personal information! Please try again.']);

            return back()->withInput();
        }

        showSuccess(['Your personal information has been updated.']);

        return redirect()->route('settings');
    }

    /**
     * @param ChangePasswordFormRequest $request
     * @return $this
     */
    public function changePassword(ChangePasswordFormRequest $request)
    {
        try {
            $user = \Auth::user();

            if ($user->getAuthPassword()) {
                if (\Hash::check($request->get('old_password'), $user->getAuthPassword())) {
                    $user->password = $request->get('new_password');
                    $user->save();

                    showSuccess(['Your password has been changed.']);
                } else {
                    showErrors(['The old password your entered is incorrect.']);

                    return back()
                        ->withInput()
                        ->withErrors([
                            'old_password' => 'The old password you entered is incorrect.',
                        ]);
                }
            } else {
                $user->password = $request->get('new_password');
                $user->save();

                showSuccess(['Your password has been set.']);
            }

        } catch (\Exception $e) {
            showErrors(['Something went wrong changing your password! Please try again.']);

            return back()->withInput();
        }

        return redirect()->route('settings');
    }
}
