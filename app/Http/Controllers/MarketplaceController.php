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

    /**
     * Show the application marketplace create offer.
     *
     * @return \Illuminate\Http\Response
     */
    public function newoffer()
    {
        return view('newoffer', array("user" => Auth::user()));
    }
}
