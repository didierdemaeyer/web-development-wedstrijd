<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class ProfileController extends Controller
{
    public function getMyEntries()
    {
        $user = \Auth::user();
        $photos = $user->photos;

        return view('profile.entries', compact('photos'));
    }

    public function getMyLikes()
    {
        $user = \Auth::user();
        $likes = $user->likes;

        return view('profile.likes', compact('likes'));
    }
}
