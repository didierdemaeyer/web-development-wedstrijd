<?php

namespace App\Classes;

use App\ContestPeriod;
use App\Photo;

class ContestService
{
    /**
     * @param ContestPeriod $period
     * @return bool
     */
    public function selectWinnerForPeriod(ContestPeriod $period)
    {
        $photos = $this->getPhotosForPeriodSortedByMostLiked($period);
        $winning_photo = $this->selectWinningPhoto($photos);

        $period->winning_photo()->associate($winning_photo);
        $period->save();

        $this->sendEmailToAdministrator($period, $winning_photo);

        return true;
    }

    /**
     * Get all photos of the current period sorted by most liked first
     *
     * @param $period
     * @return static
     */
    private function getPhotosForPeriodSortedByMostLiked($period)
    {
        return Photo::with('likes')
            ->where('created_at', '>', $period->startdate)
            ->where('created_at', '<', $period->enddate)
            ->get()
            ->sortBy(function($photo) {
                return $photo->likes->count();
            }, null, true);
    }

    /**
     * Select the winning photo from an array of photos
     *
     * @param $photos
     * @return mixed
     */
    private function selectWinningPhoto($photos)
    {
        // Get the most liked photo or photos if there are multiple with the same amount of likes
        $mostLikedPhotos = array();
        foreach ($photos as $photo) {
            if (empty($mostLikedPhotos) || (count($photo->likes) == count($mostLikedPhotos[0]))) {
                array_push($mostLikedPhotos, $photo);
            } else {
                break;
            }
        }

        // If there are multiple photos with the same amount of likes select a random photo
        if (count($mostLikedPhotos) > 1) {
            $winning_photo = $mostLikedPhotos[array_rand($mostLikedPhotos)];
        } else {
            $winning_photo = $mostLikedPhotos[0];
        }

        return $winning_photo;
    }

    /**
     * @return bool
     */
    private function sendEmailToAdministrator($period, $winning_photo)
    {
        \Mail::send('emails.winner-selected', ['winning_photo' => $winning_photo, 'period' => $period], function ($m) use ($period) {
            $m->from('noreply@wedstrijd-tnf.dev', 'TNF Wedstrijd');

            $m->to('didierdemaeyer@gmail.com', 'Didier')->subject('Winner selected for period ' . $period->period_number);
        });

        return true;
    }
}
