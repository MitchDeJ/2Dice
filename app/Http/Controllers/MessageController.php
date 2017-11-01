<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class MessageController extends Controller
{
    /**
     * Show the application inbox message.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('message', array("user" => Auth::user()));
    }
}
