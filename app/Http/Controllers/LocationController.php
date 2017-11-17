<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Location;
use App\Object;
use App\User;

class LocationController extends Controller
{
    /**
     * Show the application locations.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $location =  Location::where("id", $user->location)->get()->first();
        $object = Object::where('location', $location->id)->where('type', 2)->get()->first();
        if (User::where('id', $object->owner)->get()->count() < 1)
            $owner = null;
        else
            $owner = User::where('id', $object->owner)->get()->first();

        return view('location', array(
            "user" => $user,
            'locations' => Location::all(),
            'location' => $location,
            'object' => $object,
            'owner' => $owner
        ));
    }

    public function fly(Request $request) {
        $price = 5000;
        $fly = false;

        if (Auth::user()->cash < $price)
            return redirect('location')->with('fail', 'You currently can not afford a flight.');

        for ($i=1;$i<=3;$i++) {
            if ($request->input(['location'.$i]) != null) {
                $oldlocation = Location::where("id", Auth::user()->location)->get()->first();
                $location = Location::where("name",  $request->input(['location'.$i]))->get()->first();
                $object = Object::where('location', $oldlocation->id)->where('type', 2)->get()->first();
                Auth::user()->location = $location->id;
                Auth::user()->cash -= $price;
                $object->cash+=$price;
                $object->profit+=$price;
                $object->save();
                Auth::user()->save();

                $fly = true;
                //unlock traveller title
                ProfileController::forceUnlockTitle(3);
                break;
            }
        }
        $loc = Location::where('id', Auth::user()->location)->get()->first();
        if ($fly)
            return redirect('location')->with('success', 'You pay $'.number_format($price).' and fly to '.$loc->name.'.');
        else
            return redirect('location')->with('neutral', 'Please select a country first.');
    }

    public static function getName($loc) {
        $location = Location::where('id', $loc)->get()->first();
        return $location->name;
    }
}
