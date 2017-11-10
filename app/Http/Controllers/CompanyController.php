<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class CompanyController extends Controller
{
    /**
     * View the create company page
     *
     * @return \Illuminate\Http\Response
     */
    public function companyCreate()
    {
        return view('companycreate', array("user" => Auth::user()));
    }

    /**
     * View the company profile page
     *
     * @return \Illuminate\Http\Response
     */
    public function companyProfile()
    {
        return view('companyprofile', array("user" => Auth::user()));
    }

    /**
     * View the company leaderboard page
     *
     * @return \Illuminate\Http\Response
     */
    public function companyLeaderboard()
    {
        return view('companyleaderboard', array("user" => Auth::user()));
    }
}
