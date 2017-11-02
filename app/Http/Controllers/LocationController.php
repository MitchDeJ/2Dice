<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LocationController extends Controller
{
    /**
     * Show the application inbox message.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('location', array("user" => Auth::user()));
    }
}
