<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Ban;

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
        $bans = array();
        foreach($users as $user) {
            $bans[$user->id] = 0;
            if (Ban::where('user', $user->id)->get()->count() > 0)
                $bans[$user->id] = 1;
        }

        return view('leaderboard', array(
            'users' => $users,
            "pages" => $pages,
            "num" => $num,
            "bans" => $bans
        ));
    }

    public function getPlayer(Request $request) {
        $name = $request->input('name');
        $user = User::where("name", $name)->first();

        if ($user) {
            return redirect("profile/".$name);
        } else {
            return redirect("leaderboard/1");
        }

    }

    public function getPage(Request $request) {
        $num = (int)$request->input('pageselected');
        return redirect("leaderboard/".$num);
    }
}
