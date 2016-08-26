<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname',
        'firstname',
        'lastname',
        'email',
        'password',
        'address',
        'postcode',
        'city',
        'ip_address',
        'country_id',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Mutator to automatically hash the password
     *
     * @param $pass
     */
    public function setPasswordAttribute($pass)
    {
        $this->attributes['password'] = bcrypt($pass);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function social_accounts()
    {
        return $this->hasMany('App\SocialAccount');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
        return $this->hasMany('App\Photo');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function likes()
    {
        return $this->belongsToMany('App\Photo', 'likes');
    }

    /**
     * @return bool
     */
    public function isUserInformationComplete()
    {
        return ( ! empty($this->fullname)
            && ! empty($this->firstname)
            && ! empty($this->lastname)
            && ! empty($this->email)
            && ! empty($this->address)
            && ! empty($this->postcode)
            && ! empty($this->city)
            && ! empty($this->country));
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        return ($this->role->name == 'admin');
    }

    /**
     * @param $period
     * @param $perPage
     * @return mixed
     */
    public function getLikedPhotosForPeriod($period, $perPage)
    {
        $period = ContestPeriod::where('period_number', $period)->first();

        return $this->likes()
            ->where('photos.created_at', '>', $period->startdate)
            ->where('photos.created_at', '<', $period->enddate)
            ->paginate($perPage);
    }

    public function getMyEntriesForPeriod($period, $perPage)
    {
        $period = ContestPeriod::where('period_number', $period)->first();

        return $this->photos()
            ->where('photos.created_at', '>', $period->startdate)
            ->where('photos.created_at', '<', $period->enddate)
            ->paginate($perPage);
    }
}
