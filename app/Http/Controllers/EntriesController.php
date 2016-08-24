<?php

namespace App\Http\Controllers;

use App\Photo;
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
        $photos = Photo::all();

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
}
