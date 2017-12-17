<?php

namespace App\Console\Commands;

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\FactoryController;
use App\Http\Controllers\MarketplaceController;
use Illuminate\Console\Command;
use App\Factory;
use App\Http\Controllers\MessageController;
use App\Company;

class FactoryTick extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'factory:tick';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Give resources to all companies based on their factories';

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
        MessageController::sendSystemMessage("admin", "Factory tick done.", "");
        $companies = Company::all();

        foreach ($companies as $c) {
            $factories = Factory::where('company', $c->id)->get();
            foreach($factories as $factory) {

                /*gathering*/
                if (FactoryController::isGatherType($factory->type)) {
                    $item = FactoryController::getResultResource($factory->type);
                    $amount = FactoryController::getUnitsPerHour($factory->level);

                    $now = MarketplaceController::getItem($c, $item);
                    $limit = CompanyController::getStorageLimit($c);

                    if (!$now == $limit) { //this resource storage isnt full yet
                        if (($now + $amount) > $limit) {
                            $amount = $limit - $now;
                        }
                        MarketplaceController::addItem($c, $item, $amount);
                    }
                }

                /*processing*/
                if (FactoryController::isProcessType($factory->type)) {
                    $req = FactoryController::getRequiredResource($factory->type);
                    $item = FactoryController::getResultResource($factory->type);
                    $amount = FactoryController::getUnitsPerHour($factory->level);

                    //doesnt have enough required resources, alter the amount
                    if (!MarketplaceController::hasItem($c, $req, $amount*2)) {
                        $amount = MarketplaceController::getItem($c, $req)/2;
                    }

                    $now = MarketplaceController::getItem($c, $item);
                    $limit = CompanyController::getStorageLimit($c);

                    if (!$now == $limit) { //this resource storage isnt full yet
                        if (($now + $amount) > $limit) {
                            $amount = $limit - $now;
                        }
                        MarketplaceController::addItem($c, $item, $amount);
                        MarketplaceController::removeItem($c, $req, $amount*2);
                    }
                }

            }
        }
    }
}
