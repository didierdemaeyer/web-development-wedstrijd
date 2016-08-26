<?php

namespace App\Http\Controllers;

use App\ContestPeriod;
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
        $photos = Photo::getPhotosSortedByMostPopular(12);

        return view('entries.index', compact('photos'));
    }

    /**
     * Shows the latest entries first
     *
     * @return mixed
     */
    public function getLatestEntries()
    {
        $photos = Photo::getPhotosSortedByLatest(12);

        return view('entries.index', compact('photos'));
    }

    /**
     * Shows the oldest entries first
     *
     * @return mixed
     */
    public function getOldestEntries()
    {
        $photos = Photo::getPhotosSortedByOldest(12);

        return view('entries.index', compact('photos'));
    }

    /**
     * @param $selectedPeriod
     * @return mixed
     */
    public function getArchivedEntries($selectedPeriod)
    {
        $photos = Photo::getEntriesFromPeriod($selectedPeriod, 12);
        $periods = ContestPeriod::getPreviousPeriods();

        return view('entries.archived', compact('photos', 'periods', 'selectedPeriod'));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $photo = Photo::findOrFail($id);

        return view('entries.show', compact('photo'));
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
