<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class LeaderboardController extends Controller
{
    /**
     * View the leaderboard based on power
     *
     * @return \Illuminate\Http\Response
     */
    public function index($num)
    {
        $users = User::all()->sortByDesc('power')->slice(0+(25*($num-1)), 25);
        $pages = ceil(User::count()/25);
        return view('leaderboard', array('users' => $users, "pages" => $pages, "num" => $num));
    }

    public function getPlayer(Request $request) {
        $name = $request->input('name');
        $user = User::where("name", $name)->first();

        if ($user) {
            return app('App\Http\Controllers\ProfileController')->otherProfile($name);
        } else {
            return $this->index(1);
        }

    }

    public function getPage(Request $request) {
        $num = $request->input('pageselected');
        return $this->index((int)$num);
    }
}
