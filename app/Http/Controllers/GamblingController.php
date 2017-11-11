<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Object;
use App\Location;
use App\User;

class GamblingController extends Controller
{
    /**
     * Show the application 55x45 overview.
     *
     * @return \Illuminate\Http\Response
     */
    public function diceIndex()
    {
        return view('55x2', array("user" => Auth::user()));
    }

    /**
     * Show the application coinflip overview.
     *
     * @return \Illuminate\Http\Response
     */
    public function coinflipIndex()
    {
        return view('coinflip', array("user" => Auth::user()));
    }

    public function roll55x2(Request $request) {
        $num = rand(1, 100);
        $bet = $request->input('bet');
        $user = Auth::user();

        var_dump($bet);
        var_dump($num);

        if (!is_numeric($bet)) {
            return redirect('55x2')->with('fail', 'Invalid bet.');
        }

        if ($bet < 1) {
            return redirect('55x2')->with('fail', 'Invalid bet.');
        }

        if ($bet > $user->cash) {
            return redirect('55x2')->with('fail', 'You tried to bet $' . number_format($bet) . ', but you only have $' . number_format($user->cash) . ".");
        }

        $user->totalbets +=1;

        if ($bet > $user->highestbet)
        {
            $user->highestbet = $bet;
        }

        if ($num <= 50) {
            $user->cash-=$bet;
            $user->save();
            return redirect('55x2')->with('fail', ' You roll a ' . $num . ', you lose $' . number_format($bet) . '.');
        } else {
            $user->cash+=$bet;
            $user->save();
            return redirect('55x2')->with('success', ' You roll a ' . $num . ', you win $' . number_format($bet) . '!');
        }
    }

    /**
     * Show the application roulette overview.
     *
     * @return \Illuminate\Http\Response
     */
    public function rouletteIndex()
    {
        $user = Auth::user();
        $location =  Location::where("id", $user->location)->get()->first();
        $object = Object::where('location', $location->id)->where('type', 0)->get()->first();
        if (User::where('id', $object->owner)->get()->count() < 1)
            $owner = null;
        else
            $owner = User::where('id', $object->owner)->get()->first();

        return view('roulette', array(
            "user" => $user,
            "location" => $location,
            "object" => $object,
            "owner" => $owner
        ));
    }

    /**
     * Show the application blackjack overview.
     *
     * @return \Illuminate\Http\Response
     */
    public function blackjackIndex()
    {
        $user = Auth::user();
        $location =  Location::where("id", $user->location)->get()->first();
        $object = Object::where('location', $location->id)->where('type', 1)->get()->first();
        if (User::where('id', $object->owner)->get()->count() < 1)
            $owner = null;
        else
            $owner = User::where('id', $object->owner)->get()->first();

        return view('blackjack', array(
            "user" => $user,
            "location" => $location,
            "object" => $object,
            "owner" => $owner
        ));
    }
}
