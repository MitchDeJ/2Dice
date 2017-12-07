<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 25; $i++) {
            DB::table('users')->insert([
                'name' => str_random(10),
                'email' => str_random(10) . "@gmail.com",
                'password' => bcrypt("secret"),
                'avatar' => "default.png",
                'desc' => "this is a generated account",

                'started' => "4-20-1337",
                'lastlogin' => "4-20-1337",

                'location' => random_int(1,3),

                'rank' => random_int(1, 10),
                'xp' => 0,
                'prestige' => random_int(0, 20),
                'vip' => (boolean)random_int(0, 1),
                'power' => random_int(1, 1337),

                'cash' => random_int(1, 1000000),
                'prestigepoints' => random_int(1, 10),
                'wood' => random_int(1, 13337),
                'stone' => random_int(1, 13337),
                'wheat' => random_int(1, 13337),

                'title' => -1,
                'unlockedtitles' => serialize(array_fill(0, 20, 0)),

                'highestbet' => random_int(1, 13337),
                'totalbets' => random_int(1, 5000)
            ]);
        }
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => "admin@gmail.com",
            'password' => bcrypt("admin"),
            'avatar' => "default.png",
            'desc' => "",

            'started' => "4-20-1337",
            'lastlogin' => "4-20-1337",

            'location' => 1,

            'rank' => random_int(1, 10),
            'xp' => 0,
            'prestige' => random_int(0, 20),
            'vip' => (boolean)1,
            'power' => 1333337,

            'cash' => 100000000,
            'prestigepoints' => 10,
            'wood' => random_int(1, 13337),
            'stone' => random_int(1, 13337),
            'wheat' => random_int(1, 13337),

            'title' => -1,
            'unlockedtitles' => serialize(array_fill(0, 20, 0)),

            'highestbet' => 0,
            'totalbets' => 0
        ]);
    }
}
