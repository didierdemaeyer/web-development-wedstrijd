<?php

namespace App\Http\Controllers;

use App\Country;
use App\Http\Requests\UpdateSettingsFormRequest;
use App\Http\Requests\UploadPhotoFormRequest;
use App\Photo;
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

    public function postUploadPhoto(UploadPhotoFormRequest $request)
    {
        $user = \Auth::user();

        try {
            $file = $request->file('photo');
            $fileData = $this->getFileData($file);
            $destinationPath = config('uploads.entries.path');
            $sizes = config('uploads.entries.sizes');

            $photo = new Photo();
            $img = \Image::make($file);
            $photo = $this->resizeAndSaveImages($img, $sizes, $destinationPath, $fileData['newFilename'], $fileData['extension'], $photo);

            $photo = $user->photos()->save($photo);

        } catch (\Exception $e) {
            showErrors(['Something went wrong! Please try again.']);

            return back();
        }

        showSuccess(['Photo uploaded successfully.']);

        return redirect()->route('participate.thank-you')->with('photo_id', $photo->id);
    }

    /**
     * @return mixed
     */
    public function getCompleteInfo()
    {
        $countries = Country::orderBy('name')->get();
        $required_info = 'full';
        session()->put('required_info', $required_info);

        return view('participate.complete-info', compact('countries'));
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
                'postcode'
            );
            $userData['fullname'] = $request->get('firstname') . ' ' . $request->get('lastname');
            $userData['country_id'] = (int) $request->get('country');
            $user->update($userData);
        } catch (\Exception $e) {
            showErrors(['Something went wrong! Please try again.']);

            return back()->withInput();
        }

        showSuccess(['Your information has been updated.']);

        return redirect()->route('participate');
    }

    public function thankYou()
    {
        return view('participate.thank-you');
    }

    /**
     * @param $img
     * @param $sizes
     * @param $destinationPath
     * @param $newFilename
     * @param $fileExtension
     * @param $photo
     * @return mixed
     */
    private function resizeAndSaveImages($img, $sizes, $destinationPath, $newFilename, $fileExtension, $photo)
    {
        foreach ($sizes as $key => $size) {
            $img->resize($size, $size, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $filename = $newFilename . '-' . $key . '.' . $fileExtension;
            $img->save(public_path($destinationPath . '/' . $filename));
            $photo->{'url_' . $key} = $destinationPath . '/' . $filename;
        }

        return $photo;
    }

    /**
     * @param $file
     * @return array
     */
    private function getFileData($file)
    {
        $originalFilename = str_replace('.' . $file->getClientOriginalExtension(), '', $file->getClientOriginalName());
        $newFilename = time() . '-' . $originalFilename;
        $fileExtension = $file->getClientOriginalExtension();

        return [
            'filename' => $originalFilename,
            'newFilename' => $newFilename,
            'extension' => $fileExtension,
        ];
    }
}
