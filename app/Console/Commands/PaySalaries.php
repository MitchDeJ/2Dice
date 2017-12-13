<?php

namespace App\Console\Commands;

use App\Http\Controllers\MessageController;
use Illuminate\Console\Command;
use App\Company;
use App\Http\Controllers\CompanyController;
use App\User;

class PaySalaries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'salaries:pay';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pays out daily salaries to company members';

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
        $companies = Company::all();

        foreach ($companies as $company) {
            $members = CompanyController::getCompanyMembers($company->id);
            $count = count($members);
            $salary = CompanyController::getOptions($company->id)->salary;


            if ($salary > 0) {
                //not enough to pay out
                if (($count * $salary) > $company->cash) {
                    foreach ($members as $member) {
                        MessageController::sendSystemMessage(
                            $member->name,
                            $company->name . ' did not have enough cash to pay all salaries today.',
                            'Therefore you did not receive your salary today.'
                        );
                    }
                } else {
                    //paying out everyone
                    foreach ($members as $member) {
                        $member->cash += $salary;
                        $company->cash -= $salary;
                        $member->save();
                        $company->save();
                        MessageController::sendSystemMessage(
                            $member->name,
                            $company->name . ' has paid you your daily salary ($' . number_format($salary) . ').',
                            ''
                        );
                    }
                }
            }
        }
    }
