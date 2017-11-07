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

    public function fly(Request $request) {
        $price= 1000;

        if (Auth::user()->cash < $price)
            return redirect('location')->with('fail', 'You currently can not afford a flight.');

        for ($i=1;$i<=3;$i++) {
            if ($request->input(['location'.$i]) != null) {
                $location = Location::where("name",  $request->input(['location'.$i]))->get()->first();
                Auth::user()->location = $location->id;
                Auth::user()->cash -= $price;
                Auth::user()->save();
            }
        }
        $loc = Location::where('id', Auth::user()->location)->get()->first();
        return redirect('location')->with('success', 'You pay $'.number_format($price).' and fly to '.$loc->name.'.');
    }
}
