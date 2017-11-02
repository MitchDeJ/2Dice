<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Location;

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
        return view('dashboard', array(
            "user" => $user,
            "lbrank" => app('App\Http\Controllers\ProfileController')->getLeaderboardRank(Auth::user()->name),
            "location" => Location::where("id", $user->location)->get()->first()
            ));
    }
}
