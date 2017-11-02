<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class GamblingController extends Controller
{
    /**
     * Show the application 55x45 overview.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('55x45', array("user" => Auth::user()));
    }

    /**
     * Show the application coinflip overview.
     *
     * @return \Illuminate\Http\Response
     */
    public function coinflip()
    {
        return view('coinflip', array("user" => Auth::user()));
    }
}
