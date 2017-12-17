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
        $adminid = User::where('name', "admin")->get()->first()->id;
        $toprichest = User::where('id', '!=',  $adminid)->get()->sortByDesc('cash')->slice(0, 5);
        $topranked = User::where('id', '!=',  $adminid)->orderBy('prestige', 'DESC')->orderBy('rank', 'DESC')->get()->slice(0, 5);
        $topbets = User::where('id', '!=',  $adminid)->get()->sortByDesc('highestbet')->slice(0, 5);
        $toptotalbets = User::where('id', '!=',  $adminid)->get()->sortByDesc('totalbets')->slice(0, 5);

        return view('statistics', array(
            "user" => Auth::user(),
            "toprichest" => $toprichest,
            "topranked" => $topranked,
            "topbets" => $topbets,
            "toptotalbets" => $toptotalbets,
        ));
    }
}
