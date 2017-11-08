<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class VipController extends Controller
{
    /**
     * Show the application VIP overview.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('vip', array("user" => Auth::user()));
    }
}
