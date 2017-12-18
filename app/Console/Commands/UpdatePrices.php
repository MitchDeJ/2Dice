<?php

namespace App\Console\Commands;

use App\Location;
use Illuminate\Console\Command;

class UpdatePrices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'prices:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update all quicksell prices';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $locations = Location::all();

        $min = 1;
        $max = 100;

        $pmin = 50;
        $pmax = 200;

        foreach($locations as $loc) {

            $price = rand($min, $max);
            $loc->woodprice = $price;
            $price = rand($min, $max);
            $loc->stoneprice = $price;
            $price = rand($min, $max);
            $loc->oilprice = $price;

            $price = rand($pmin, $pmax);
            $loc->planksprice = $price;
            $price = rand($pmin, $pmax);
            $loc->bricksprice = $price;
            $price = rand($pmin, $pmax);
            $loc->gasolineprice = $price;

            $loc->save();
        }
    }
}
