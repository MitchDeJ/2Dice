<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Company;

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
        $topranked = User::orderBy('prestige', 'DESC')->orderBy('rank', 'DESC')->get()->slice(0, 5);
        $topbets = User::all()->sortByDesc('highestbet')->slice(0, 5);
        $toptotalbets = User::all()->sortByDesc('totalbets')->slice(0, 5);

        return view('statistics', array(
            "user" => Auth::user(),
            "toprichest" => $toprichest,
            "topranked" => $topranked,
            "topbets" => $topbets,
            "toptotalbets" => $toptotalbets,
        ));
    }
}
