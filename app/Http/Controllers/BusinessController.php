<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class BusinessController extends Controller
{
    /**
     * Show the application send cash view.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sendcash', array("user" => Auth::user()));
    }

    /**
     * Show the application collaboration view.
     *
     * @return \Illuminate\Http\Response
     */
    public function collab()
    {
        return view('collab', array("user" => Auth::user()));
    }
}
