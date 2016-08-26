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
                'startdate' => '2016-08-27 00:00:00',
                'enddate' => '2016-08-28 23:59:59',
            ],
            [
                'period_number' => 2,
                'startdate' => '2016-08-29 00:00:00',
                'enddate' => '2016-08-30 23:59:59',
            ],
            [
                'period_number' => 3,
                'startdate' => '2016-08-31 00:00:00',
                'enddate' => '2016-09-01 23:59:59',
            ],
            [
                'period_number' => 4,
                'startdate' => '2016-09-02 00:00:00',
                'enddate' => '2016-09-03 23:59:59',
            ],
        ];

        foreach ($periods as $period) {
            \App\ContestPeriod::create($period);
        }
    }
}
