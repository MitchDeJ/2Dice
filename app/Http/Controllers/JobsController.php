<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class JobsController extends Controller
{
    /**
     * Show the application jobs overview.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('jobs', array("user" => Auth::user()));
    }
}