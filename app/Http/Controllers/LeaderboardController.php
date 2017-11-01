<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LeaderboardController extends Controller
{
    /**
     * View the leaderboard based on power
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('leaderboard', array("user" => Auth::user()));
    }
}
