<?php

namespace App;

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
}
