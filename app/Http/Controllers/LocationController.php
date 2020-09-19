<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Location;
use App\GameObject;
use App\User;
use App\Cooldown;

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
        $object = GameObject::where('location', $location->id)->where('type', 2)->get()->first();
        if (User::where('id', $object->owner)->get()->count() < 1)
            $owner = null;
        else
            $owner = User::where('id', $object->owner)->get()->first();

        if ($user::onCooldown($user, 69)) {
            $cooldown = Cooldown::where('user', $user->id)->where('type', 69)->get()->first();
        } else {
            $cooldown = null;
        }

        return view('location', array(
            "user" => $user,
            'locations' => Location::all(),
            'location' => $location,
            'object' => $object,
            'owner' => $owner,
            'cooldown' => $cooldown
        ));
    }

    public function fly(Request $request) {
        $price = 5000;
        $fly = false;
        $user = Auth::user();

        if ($user::onCooldown($user, 69)) {
            return redirect('location')->with('fail', 'Currently there are no planes available for flight.');
        }

        if (Auth::user()->cash < $price)
            return redirect('location')->with('fail', 'You currently can not afford a flight.');

        for ($i=1;$i<=3;$i++) {
            if ($request->input(['location'.$i]) != null) {
                $oldlocation = Location::where("id", Auth::user()->location)->get()->first();
                $location = Location::where("name",  $request->input(['location'.$i]))->get()->first();
                $object = GameObject::where('location', $oldlocation->id)->where('type', 2)->get()->first();
                Auth::user()->location = $location->id;
                Auth::user()->cash -= $price;
                $object->cash+=$price;
                $object->profit+=$price;
                $object->save();
                Auth::user()->save();

                //set flight cooldown
                if ($user->vip == true) {
                    $user::addCooldown($user, 69, 60 * 10);
                } else {
                    $user::addCooldown($user, 69, 60 * 30);
                }

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

    public static function getSellPrice($loc, $item) { //get quick sell price of an item in this location
        $location = Location::where('id', $loc)->get()->first();
        switch ($item) {
            case 0://wood
                return $location->woodprice;
            case 1://stone
                return $location->stoneprice;
            case 2://oil
                return $location->oilprice;
            case 3:
                return 0;
            case 4://planks
                return $location->planksprice;
            case 5://bricks
                return $location->bricksprice;
            case 6://gasoline
                return $location->gasolineprice;
        }
    }
}
