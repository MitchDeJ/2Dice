<?php

use Illuminate\Database\Seeder;

class ObjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($t = 0; $t < 3; $t++) {
            for ($i = 1; $i < 4; $i++) {
                DB::table('objects')->insert([
                    'type' => $t,
                    'location' => $i,
                    'owner' => -1,
                    'cash' => 0,
                    'maxbet' => 0,
                    'profit' => 0
                ]);
            }
        }
    }
}
