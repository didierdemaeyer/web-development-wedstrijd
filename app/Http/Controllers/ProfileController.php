<?php

namespace App\Http\Controllers;

use App\ContestPeriod;
use Illuminate\Http\Request;
use App\Http\Requests;

class ProfileController extends Controller
{
    /**
     * @param $selectedPeriod
     * @return mixed
     */
    public function getMyEntries($selectedPeriod)
    {
        $user = \Auth::user();
        $photos = $user->getMyEntriesForPeriod($selectedPeriod, 12);
        $periods = ContestPeriod::getCurrentAndPreviousPeriods();

        return view('profile.entries', compact('photos', 'periods', 'selectedPeriod'));
    }

    /**
     * @param $selectedPeriod
     * @return mixed
     */
    public function getMyLikes($selectedPeriod)
    {
        $user = \Auth::user();
        $photos = $user->getLikedPhotosForPeriod($selectedPeriod, 12);
        $periods = ContestPeriod::getCurrentAndPreviousPeriods();


        return view('profile.likes', compact('photos', 'periods', 'selectedPeriod'));
    }
}
