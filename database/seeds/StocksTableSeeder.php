<?php

use Illuminate\Database\Seeder;

class StocksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i += 1) {

            $price = 1000;
            $price = rand($price-500,$price+500);

            DB::table('stocks')->insert([
                'id' => $i,
                'name' => $this::getStockName($i),
                'lastprice' => rand($price-150,$price+150),
                'price' => $price,
            ]);
        }
    }

    public function getStockName($id)
    {
        switch($id)
        {
            case 1:
                return "Jamflex Studios";
            case 2:
                return "AgRee Supermarkets";
            case 3:
                return "Scalba Bakeries";
            case 4:
                return "OOMEN Technology";
            case 5:
                return "AE Sports";
            case 6:
                return "Motherlode Mining";
            case 7:
                return "Astra Supercars";
            case 8:
                return "Corsa Travels";
            case 9:
                return "TimeToDice Casinos";
            case 10:
                return "M1tch Software";
        }
    }
}
