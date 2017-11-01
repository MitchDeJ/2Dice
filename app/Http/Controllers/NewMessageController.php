<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class NewMessageController extends Controller
{
    /**
     * Show the application new message.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('newmessage', array("user" => Auth::user()));
    }
}
