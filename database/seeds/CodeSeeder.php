<?php

use Illuminate\Database\Seeder;

class CodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $CODES_TO_GENERATE = 100;
        $SEPERATOR = "-";

        for ($i = 0; $i < $CODES_TO_GENERATE; $i++) {

            $part1 = $this->generateRandomString(4);
            $part2 = $this->generateRandomString(4);
            $part3 = $this->generateRandomString(4);

            $code = $part1.$SEPERATOR.$part2.$SEPERATOR.$part3;
            $this->writeToFile($code);
            DB::table('codes')->insert([
                'code' => $code,
                'used' => false,
                'user' => null
            ]);
        }
    }

    function generateRandomString($length) {
        $include_chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        /* Uncomment below to include symbols */
        /* $include_chars .= "[{(!@#$%^/&*_+;?\:)}]"; */
        $charLength = strlen($include_chars);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $include_chars [rand(0, $charLength - 1)];
        }
        return $randomString;
    }

    function writeToFile($code) {
        $fp = fopen('keys.txt', 'a');//opens file in append mode
        fwrite($fp, $code."\n" );
        fclose($fp);
    }
}
