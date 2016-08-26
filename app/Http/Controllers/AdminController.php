<?php

namespace App\Http\Controllers;

use App\ContestPeriod;
use App\Photo;
use Illuminate\Http\Request;
use App\Http\Requests;

class AdminController extends Controller
{
    /**
     * @param $selectedPeriod
     * @param Request $request
     * @return mixed
     */
    public function getEntries($selectedPeriod, Request $request)
    {
        $sort = $request->has('sort') ? $request->get('sort') : 'date';
        $order = $request->has('order') ? $request->get('order') : 'desc';
        $periods = ContestPeriod::getCurrentAndPreviousPeriods();

        $photos = Photo::getEntriesFromPeriodSortedBy($selectedPeriod, $sort, $order, 10);

        $data = compact(
            'photos',
            'periods',
            'selectedPeriod',
            'sort',
            'order'
        );

        return view('admin.entries', $data);
    }
}
