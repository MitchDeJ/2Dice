<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class InboxController extends Controller
{
    /**
     * Show the application inbox messsages.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('inbox', array("user" => Auth::user()));
    }
}
