<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Location;
use App\Subscription;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if (Subscription::where('user', $user->id)->get()->count() > 0)
            $subscription = Subscription::where('user', $user->id)->get()->first();
        else
            $subscription = null;
        return view('dashboard', array(
            "user" => $user,
            "lbrank" => ProfileController::getLeaderboardRank(Auth::user()->name),
            "location" => Location::where("id", $user->location)->get()->first(),
            "subscription" => $subscription
            ));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function gameinformation ()
    {
        return view('gameinformation');
    }
}
