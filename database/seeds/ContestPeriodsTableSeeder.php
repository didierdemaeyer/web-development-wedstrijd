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
                'startdate' => '2016-08-25 00:00:00',
                'enddate' => '2016-08-25 23:59:59',
            ],
            [
                'startdate' => '2016-08-26 00:00:00',
                'enddate' => '2016-08-26 23:59:59',
            ],
            [
                'startdate' => '2016-08-27 00:00:00',
                'enddate' => '2016-08-27 23:59:59',
            ],
            [
                'startdate' => '2016-08-28 00:00:00',
                'enddate' => '2016-08-28 23:59:59',
            ],
        ];

        foreach ($periods as $period) {
            \App\ContestPeriod::create($period);
        }
    }
}
