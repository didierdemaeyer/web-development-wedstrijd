<?php

use Illuminate\Database\Seeder;

class ContestPeriodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('contest_periods')->delete();

        $periods = [
            [
                'period_number' => 1,
                'startdate' => '2016-08-23 00:00:00',
                'enddate' => '2016-08-23 23:59:59',
            ],
            [
                'period_number' => 2,
                'startdate' => '2016-08-24 00:00:00',
                'enddate' => '2016-08-24 23:59:59',
            ],
            [
                'period_number' => 3,
                'startdate' => '2016-08-25 00:00:00',
                'enddate' => '2016-08-25 23:59:59',
            ],
            [
                'period_number' => 4,
                'startdate' => '2016-08-26 00:00:00',
                'enddate' => '2016-08-26 23:59:59',
            ],
            [
                'period_number' => 5,
                'startdate' => '2016-08-27 00:00:00',
                'enddate' => '2016-08-27 23:59:59',
            ],
            [
                'period_number' => 6,
                'startdate' => '2016-08-28 00:00:00',
                'enddate' => '2016-08-28 23:59:59',
            ],
        ];

        foreach ($periods as $period) {
            \App\ContestPeriod::create($period);
        }
    }
}
