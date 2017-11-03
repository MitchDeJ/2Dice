<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class StatisticsController extends Controller
{
    /**
     * Show the application statistics overview.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $toprichest = User::all()->sortByDesc('cash')->slice(0, 5);
        $topranked = User::all()->sortByDesc('prestige')->sortByDesc('rank')->sortByDesc('xp')->slice(0, 5);
        $topbets = User::all()->sortByDesc('highestbet')->slice(0, 5);
        $toptotalbets = User::all()->sortByDesc('totalbets')->slice(0, 5);
        return view('statistics', array(
            "user" => Auth::user(),
            "toprichest" => $toprichest,
            "topranked" => $topranked,
            "topbets" => $topbets,
            "toptotalbets" => $toptotalbets
        ));
    }
}
