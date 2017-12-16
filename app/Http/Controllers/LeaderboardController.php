<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Ban;
use App\Company;

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

    /*
     * Comapany leaderboard
     */

    public function companyIndex($num)
    {
        $companies = Company::all()->sortByDesc('level')->slice(0+(25*($num-1)), 25);

        $members = array();
        $totalpower = array();

        foreach($companies as $c) {
            $members[$c->id] = count(CompanyController::getCompanyMembers($c->id));
            $power = 0;
            foreach(CompanyController::getCompanyMembers($c->id) as $m) {
                $power += $m->power;
            }
            $totalpower[$c->id] = $power;
        }

        $pages = ceil(Company::count()/25);

        return view('companyleaderboard', array(
            'companies' => $companies,
            'members' => $members,
            'totalpower' => $totalpower,
            "pages" => $pages,
            "num" => $num,
        ));
    }

    public function getCompany(Request $request) {
        $name = $request->input('name');
        $company = Company::where("name", $name)->first();

        if ($company) {
            return redirect("companyprofile/".$name);
        } else {
            return redirect("companyleaderboard/1");
        }

    }

    public function getCompanyPage(Request $request) {
        $num = (int)$request->input('pageselected');
        return redirect("companyleaderboard/".$num);
    }
}
