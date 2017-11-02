<?php

use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('locations')->insert([
            'name' => "Netherlands",
            'flag' => "netherlands.png"
        ]);
        DB::table('locations')->insert([
            'name' => "United Kingdom",
            'flag' => "uk.png"
        ]);
        DB::table('locations')->insert([
            'name' => "Russia",
            'flag' => "russia.png"
        ]);
    }
}
