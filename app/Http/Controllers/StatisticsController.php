<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class StatisticsController extends Controller
{
    /**
     * Show the application statistics overview.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('statistics', array("user" => Auth::user()));
    }
}
