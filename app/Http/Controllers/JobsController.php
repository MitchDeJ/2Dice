<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;


class JobsController extends Controller
{
    /**
     * Show the application jobs overview.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('jobs', array("user" => Auth::user()));
    }

    public function businessJob(Request $request) {
        $user = Auth::user();
        $action = $request->input('action');
        $num = $request->input('num');

        if ($action == "moneyjob") {
            $minCash = 1000;
            $maxCash = 10000;
            $minXp = $this->getMinXp($num)/2;
            $maxXp = $this->getMaxXp($num)/2;
        }

        else if ($action == "xpjob") {
            $minCash = 1000/2;
            $maxCash = 10000/2;
            $minXp = $this->getMinXp($num);
            $maxXp = $this->getMaxXp($num);
        }

        else {
            return;
        }

        $cashReward = rand($minCash, $maxCash) * $this->getMultiplier($num);
        $xpReward = rand($minXp, $maxXp) * $this->getMultiplier($num);

        $user->cash += $cashReward;
        RankController::addXp($user, $xpReward);

        $user->save();

        return redirect('jobs') ->with('success', 'You nailed the business job! 
        You receive $'. number_format($cashReward).' and gain '.number_format($xpReward).' XP.');
    }

    public function getMultiplier($num) {
        switch ($num) {
            case 1:
                return 1;

            case 2:
                return 1.25;

            case 3:
                return 1.50;

            case 4:
                return 1.75;

            case 5:
                return 2;

        }
    }

    public function getMinXp($num) {
        switch($num) {
            case 1:
                return 1100;
            case 2:
                return 1300;
            case 3:
                return 1500;
            case 4:
                return 1500;
            case 5:
                return 1700;
        }
    }

    public function getMaxXp($num) {
        switch($num) {
            case 1:
                return 1300;
            case 2:
                return 1500;
            case 3:
                return 1700;
            case 4:
                return 1700;
            case 5:
                return 1900;
        }
    }

    public function getMinutes($num) {
        switch($num) {
            case 1:
                return 2;
            case 2:
                return 4;
            case 3:
                return 6;
            case 4:
                return 8;
            case 5:
                return 10;
        }
    }
}