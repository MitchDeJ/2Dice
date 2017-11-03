<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ShopController extends Controller
{
    /**
     * Show the application general store overview.
     *
     * @return \Illuminate\Http\Response
     */
    public function general()
    {
        return view('general', array("user" => Auth::user()));
    }

    /**
     * Show the application prestige store overview.
     *
     * @return \Illuminate\Http\Response
     */
    public function prestige()
    {
        return view('prestige', array("user" => Auth::user()));
    }
}
