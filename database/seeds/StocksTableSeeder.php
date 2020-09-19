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
                return "2Dice Ltd";
            case 2:
                return "Upgrader Studios";
            case 3:
                return "Pinto Productions";
            case 4:
                return "Wood Technology";
            case 5:
                return "Basic Fitness";
            case 6:
                return "The Golden Trident";
            case 7:
                return "Sheep & Lemon";
            case 8:
                return "Carlos Audio";
            case 9:
                return "Bet-Tastic Casinos";
            case 10:
                return "RoFlex Ltd";
        }
    }
}
