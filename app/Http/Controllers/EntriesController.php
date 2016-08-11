<?php

namespace App\Http\Controllers;

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
        return view('entries.index');
    }

    /**
     * Shows the latest entries first
     *
     * @return mixed
     */
    public function getLatestEntries()
    {
        return view('entries.index');
    }

    /**
     * Shows the oldest entries first
     *
     * @return mixed
     */
    public function getOldestEntries()
    {
        return view('entries.index');
    }
}
