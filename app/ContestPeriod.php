<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ContestPeriod extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'startdate',
        'enddate',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'startdate',
        'enddate',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function winning_photo()
    {
        return $this->belongsTo('App\Photo', 'photo_id');
    }

    /**
     * @return mixed
     */
    public static function getCurrentPeriod()
    {
        return ContestPeriod::where('startdate', '<', Carbon::now())
            ->where('enddate', '>', Carbon::now())
            ->first();
    }

    /**
     * @return mixed
     */
    public static function getPreviousPeriods()
    {
        return ContestPeriod::where('enddate', '<', Carbon::now())
            ->orderBy('enddate', 'ASC')
            ->get();
    }

    /**
     * @return mixed
     */
    public static function getPreviousPeriod()
    {
        return ContestPeriod::where('enddate', '<', Carbon::now())
            ->orderBy('enddate', 'DESC')
            ->first();
    }

    /**
     * @return mixed
     */
    public static function getCurrentAndPreviousPeriods()
    {
        return ContestPeriod::where('startdate', '<', Carbon::now())
            ->orderBy('startdate', 'ASC')
            ->get();
    }
}
