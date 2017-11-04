<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class StockmarketController extends Controller
{
    /**
     * Show the application stockmarket overview.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('stockmarket', array("user" => Auth::user()));
    }
}
