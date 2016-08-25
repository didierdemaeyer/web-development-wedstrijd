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
    public static function getPhotosSortedByMostPopular()
    {
        $currentContestPeriod = ContestPeriod::getCurrentPeriod();

        return Photo::with('likes')
            ->where('created_at', '>', $currentContestPeriod->startdate)
            ->where('created_at', '<', $currentContestPeriod->enddate)
            ->get()
            ->sortBy(function($photo) {
                return $photo->likes->count();
            }, null, true);
    }

    /**
     * @return mixed
     */
    public static function getPhotosSortedByLatest()
    {
        $currentContestPeriod = ContestPeriod::getCurrentPeriod();

        return Photo::where('created_at', '>', $currentContestPeriod->startdate)
            ->where('created_at', '<', $currentContestPeriod->enddate)
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    /**
     * @return mixed
     */
    public static function getPhotosSortedByOldest()
    {
        $currentContestPeriod = ContestPeriod::getCurrentPeriod();

        return Photo::where('created_at', '>', $currentContestPeriod->startdate)
            ->where('created_at', '<', $currentContestPeriod->enddate)
            ->orderBy('created_at', 'ASC')
            ->get();
    }

    /**
     * @param $amount
     * @return mixed
     */
    public static function getLatestEntries($amount)
    {
        $currentContestPeriod = ContestPeriod::getCurrentPeriod();

        return Photo::where('created_at', '>', $currentContestPeriod->startdate)
            ->where('created_at', '<', $currentContestPeriod->enddate)
            ->orderBy('created_at', 'DESC')
            ->take($amount)
            ->get();
    }
}
