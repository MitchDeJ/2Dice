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

        if ($action == "moneyjob") {
            $minCash = 1000;
            $maxCash = 10000;
//            $minXp = 100;
//            $maxXp = 200;
        }

        if ($action == "xpjob") {
            $minCash = 100;
            $maxCash = 1000;
            $minXp = 250;
            $maxXp = 500;
        }

        $cashReward = rand($minCash, $maxCash);
//        $xpReward = rand($minXp, $maxXp);

        $user->cash += $cashReward;
//        $user->xp += $xpReward;

        $user->save();

        return redirect('jobs') ->with( 'success', 'You nailed the business job and received $'. number_format($cashReward));
    }
}