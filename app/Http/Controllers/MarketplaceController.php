<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class MarketplaceController extends Controller
{
    /**
     * Show the application marketplace overview.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('marketplace', array("user" => Auth::user()));
    }
}
