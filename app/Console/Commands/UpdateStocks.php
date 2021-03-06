<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
Use App\Http\Controllers\StocksController;

class UpdateStocks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stocks:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update stock prices';

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
        StocksController::update();
    }
}
