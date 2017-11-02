<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Location;

class LocationController extends Controller
{
    /**
     * Show the application locations.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('location', array("user" => Auth::user(), 'locations' => Location::all()));
    }
}
