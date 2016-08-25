<?php

namespace App\Http\Controllers;

use App\Photo;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;

class EntriesController extends Controller
{
    /**
     * Shows the most popular entries first
     *
     * @return mixed
     */
    public function getPopularEntries()
    {
        $photos = Photo::with('likes')->get()->sortBy(function($photo) {
            return $photo->likes->count();
        }, null, true);

        return view('entries.index', compact('photos'));
    }

    /**
     * Shows the latest entries first
     *
     * @return mixed
     */
    public function getLatestEntries()
    {
        $photos = Photo::orderBy('created_at', 'DESC')->get();

        return view('entries.index', compact('photos'));
    }

    /**
     * Shows the oldest entries first
     *
     * @return mixed
     */
    public function getOldestEntries()
    {
        $photos = Photo::orderBy('created_at', 'ASC')->get();

        return view('entries.index', compact('photos'));
    }

    public function show($id)
    {
        $photo = Photo::findOrFail($id);

        dd($photo);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function likePhoto(Request $request)
    {
        try {
            $user = User::findOrFail($request->get('user-id'));
            $photo = Photo::findOrFail($request->get('photo-id'));

            $user->likes()->attach($photo, ['ip_address' => $request->get('ip-address')]);

            $data = array(
                'type'     => 'success',
                'code'     => '200',
                'messages' => array(
                    'You\'ve liked the photo.',
                ),
            );
        } catch (\Exception $e) {
            $data = array(
                'type'     => 'error',
                'code'     => '500',
                'messages' => array(
                    'Something went wrong liking the photo.',
                ),
            );
        }

        return $data;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function unlikePhoto(Request $request)
    {
        try {
            $user = User::findOrFail($request->get('user-id'));
            $photo = Photo::findOrFail($request->get('photo-id'));

            $user->likes()->detach($photo, ['ip_address' => $request->get('ip-address')]);

            $data = array(
                'type'     => 'success',
                'code'     => '200',
                'messages' => array(
                    'You\'ve unliked the photo.',
                ),
            );
        } catch (\Exception $e) {
            $data = array(
                'type'     => 'error',
                'code'     => '500',
                'messages' => array(
                    'Something went wrong unliking the photo.',
                ),
            );
        }

        return $data;
    }
}
