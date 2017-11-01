<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ChangePasswordController extends Controller
{
    /**
     * Change the user password
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('changepassword', array("user" => Auth::user()));
    }
}
