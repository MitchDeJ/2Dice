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
        for ($i = 0; $i < 100; $i++) {
            DB::table('users')->insert([
                'name' => str_random(10),
                'email' => str_random(10) . "@gmail.com",
                'password' => bcrypt("secret"),
                'avatar' => "default.png",
                'desc' => "this is a generated account",
                'power' => random_int(1, 1337),
                'cash' => random_int(1, 1000000),
                'companyid' => -1,
                'title' => -1,
                'unlocked_titles' => serialize(array_fill(0, 20, 0))
            ]);
        }
    }
}
