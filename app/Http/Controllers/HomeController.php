<?php

namespace App\Http\Controllers;

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
        $photos = Photo::orderBy('created_at', 'DESC')->take(8)->get();

        return view('home', compact('photos'));
    }
}
