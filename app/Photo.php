<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'url',
        'ip_address',
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
     * @param User $user
     * @return bool
     */
    public function isLikedbyUser(User $user)
    {
        return count($this->likes->where('id', $user->id)->first());
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
     * @return bool
     */
    public function isFromCurrentPeriod()
    {
        $currentContestPeriod = ContestPeriod::getCurrentPeriod();

        return ($this->created_at >= $currentContestPeriod->startdate) && ($this->created_at <= $currentContestPeriod->enddate);
    }
}
