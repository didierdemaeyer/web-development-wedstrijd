<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photo extends Model
{
    use SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'url',
        'ip_address',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function likes()
    {
        return $this->belongsToMany('App\User', 'likes');
    }

    /**
     * @return static
     */
    public static function getPhotosSortedByMostPopular($perPage)
    {
        $currentContestPeriod = ContestPeriod::getCurrentPeriod();

        return Photo::leftJoin('likes', 'photos.id', '=', 'likes.photo_id')
            ->where('photos.created_at', '>=', $currentContestPeriod->startdate)
            ->where('photos.created_at', '<=', $currentContestPeriod->enddate)
            ->selectRaw('photos.*, count(likes.photo_id) AS `count`')
            ->groupBy('photos.id')
            ->orderBy('count','DESC')
            ->paginate($perPage);
    }

    /**
     * @param $perPage
     * @return mixed
     */
    public static function getPhotosSortedByLatest($perPage)
    {
        $currentContestPeriod = ContestPeriod::getCurrentPeriod();

        return Photo::where('created_at', '>=', $currentContestPeriod->startdate)
            ->where('created_at', '<=', $currentContestPeriod->enddate)
            ->orderBy('created_at', 'DESC')
            ->paginate($perPage);
    }

    /**
     * @param $perPage
     * @return mixed
     */
    public static function getPhotosSortedByOldest($perPage)
    {
        $currentContestPeriod = ContestPeriod::getCurrentPeriod();

        return Photo::where('created_at', '>=', $currentContestPeriod->startdate)
            ->where('created_at', '<=', $currentContestPeriod->enddate)
            ->orderBy('created_at', 'ASC')
            ->paginate($perPage);
    }

    /**
     * @param $amount
     * @return mixed
     */
    public static function getLatestEntries($amount)
    {
        $currentContestPeriod = ContestPeriod::getCurrentPeriod();

        return Photo::where('created_at', '>=', $currentContestPeriod->startdate)
            ->where('created_at', '<=', $currentContestPeriod->enddate)
            ->orderBy('created_at', 'DESC')
            ->take($amount)
            ->get();
    }

    /**
     * @param $period
     * @param $perPage
     * @return mixed
     */
    public static function getEntriesFromPeriod($period, $perPage)
    {
        $period = ContestPeriod::where('period_number', $period)->first();

        return Photo::leftJoin('likes', 'photos.id', '=', 'likes.photo_id')
            ->where('photos.created_at', '>=', $period->startdate)
            ->where('photos.created_at', '<=', $period->enddate)
            ->selectRaw('photos.*, count(likes.photo_id) AS `count`')
            ->groupBy('photos.id')
            ->orderBy('count','DESC')
            ->paginate($perPage);
    }

    /**
     * @param $period
     * @param $sort
     * @param $order
     * @param $perPage
     * @return mixed
     */
    public static function getEntriesFromPeriodSortedBy($period, $sort, $order, $perPage)
    {
        $period = ContestPeriod::where('period_number', $period)->first();

        if ($sort == 'likes') {
            $results = Photo::leftJoin('likes', 'photos.id', '=', 'likes.photo_id')
                ->where('photos.created_at', '>=', $period->startdate)
                ->where('photos.created_at', '<=', $period->enddate)
                ->selectRaw('photos.*, count(likes.photo_id) AS `count`')
                ->groupBy('photos.id')
                ->orderBy('count', $order)
                ->paginate($perPage);
        } elseif ($sort == 'date' || $sort == 'ip_address') {
            $sort = ($sort == 'date') ? 'created_at' : 'ip_address';

            $results = Photo::where('created_at', '>=', $period->startdate)
                ->where('created_at', '<=', $period->enddate)
                ->orderBy($sort, $order)
                ->paginate($perPage);
        } elseif($sort == 'country') {
            $results = Photo::leftJoin('users', 'photos.user_id', '=', 'users.id')
                ->leftJoin('countries', 'users.country_id', '=', 'countries.id')
                ->where('photos.created_at', '>=', $period->startdate)
                ->where('photos.created_at', '<=', $period->enddate)
                ->orderBy('countries.name', $order)
                ->paginate($perPage);
        } else {
            $sort = ($sort == 'name') ? 'firstname' : $sort;

            $results = Photo::leftJoin('users', 'photos.user_id', '=', 'users.id')
                ->where('photos.created_at', '>=', $period->startdate)
                ->where('photos.created_at', '<=', $period->enddate)
                ->orderBy('users.' . $sort, $order)
                ->paginate($perPage);
        }

        return $results;
    }

    /**
     * @param $day
     * @return mixed
     */
    public static function getEntriesFromDayForExport($day)
    {
        return Photo::where('created_at', '>=', $day . ' 00:00:00')
            ->where('created_at', '<=', $day . ' 23:59:59')
            ->orderBy('created_at', 'ASC')
            ->get();
    }

    /**
     * @param $period
     * @return mixed
     */
    public static function getEntriesFromPeriodForExport($period)
    {
        $period = ContestPeriod::where('period_number', $period)->first();

        return Photo::where('created_at', '>=', $period->startdate)
            ->where('created_at', '<=', $period->enddate)
            ->orderBy('created_at', 'ASC')
            ->get();
    }

    /**
     * @return bool
     */
    public function isFromCurrentPeriod()
    {
        $currentContestPeriod = ContestPeriod::getCurrentPeriod();

        return ($this->created_at >= $currentContestPeriod->startdate) && ($this->created_at <= $currentContestPeriod->enddate);
    }

    /**
     * @param User $user
     * @return bool
     */
    public function isLikedbyUser(User $user)
    {
        return count($this->likes->where('id', $user->id)->first());
    }
}
