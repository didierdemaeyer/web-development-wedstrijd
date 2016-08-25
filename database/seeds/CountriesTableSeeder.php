<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('countries')->delete();

        $countries = [
            ['name' => 'Belgium'],
            ['name' => 'Netherlands'],
            ['name' => 'Luxembourg'],
        ];

        foreach ($countries as $country) {
            \App\Country::create($country);
        }
    }
}
