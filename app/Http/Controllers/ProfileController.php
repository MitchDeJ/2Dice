<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * View the user's profile
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile');
    }
}
