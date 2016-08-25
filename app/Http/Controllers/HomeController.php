<?php

namespace App\Http\Controllers;

use App\ContestPeriod;
use App\Photo;
use Illuminate\Http\Request;
use App\Http\Requests;

class HomeController extends Controller
{
    /**
     * @return mixed
     */
    public function index()
    {
        $photos = Photo::getLatestEntries(8);
        $previousPeriods = ContestPeriod::getPreviousPeriods();

        return view('home', compact('photos', 'previousPeriods'));
    }
}
