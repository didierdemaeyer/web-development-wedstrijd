<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSettingsFormRequest;
use Illuminate\Http\Request;
use App\Http\Requests;

class ParticipationController extends Controller
{
    /**
     * @return mixed
     */
    public function getUploadPhoto()
    {
        if (! \Auth::check()) {
            showInfo(['Please log in or register to participate in the contest.']);

            return redirect()->route('auth.login');
        }

        $user = \Auth::user();

        if ( ! $user->isUserInformationComplete()) {
            return redirect()->route('participate.complete-info');
        }
        
        return view('participate.upload-photo');
    }

    public function postUploadPhoto(Request $request)
    {
        dd('not implemented yet!');
    }

    /**
     * @return mixed
     */
    public function getCompleteInfo()
    {
        $required_info = 'full';
        session()->put('required_info', $required_info);

        return view('participate.complete-info');
    }

    /**
     * @param UpdateSettingsFormRequest $request
     * @return $this
     */
    public function postCompleteInfo(UpdateSettingsFormRequest $request)
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
            showErrors(['Something went wrong! Please try again.']);

            return back()->withInput();
        }

        showSuccess(['Your information has been updated.']);

        return redirect()->route('participate');
    }
}
