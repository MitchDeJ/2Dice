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
        $user = Auth::user();
        $location =  Location::where("id", $user->location)->get()->first();
        $object = Object::where('location', $location->id)->where('type', 3)->get()->first();
        if (User::where('id', $object->owner)->get()->count() < 1)
            $owner = null;
        else
            $owner = User::where('id', $object->owner)->get()->first();

        return view('55x2', array(
            "user" => $user,
            "location" => $location,
            "object" => $object,
            "owner" => $owner
        ));
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
        $location = Location::where('id', $user->location)->get()->first();
        $object = Object::where('location', $user->location)->where('type', 3)->get()->first();
        $owner = User::where('id', $object->owner)->get()->first();

        if (!is_numeric($bet)) {
            return redirect('55x2')->with('fail', 'Invalid bet.');
        }

        if ($bet < 1) {
            return redirect('55x2')->with('fail', 'Invalid bet.');
        }

        if ($bet > $user->cash) {
            return redirect('55x2')->with('fail', 'You tried to bet $' . number_format($bet) . ', but you only have $' . number_format($user->cash) . ".");
        }

        if ($bet > $object->maxbet) {
            return redirect('55x2')->with('fail', 'You can not place a bet higher than the maximum bet.');
        }

        $user->totalbets +=1;

        if ($bet > $user->highestbet)
        {
            $user->highestbet = $bet;
        }

        if ($num <= 50) {
            $user->cash-=$bet;
            $object->cash+=$bet;
            $object->profit+=$bet;
            $object->save();
            $user->save();
            return redirect('55x2')->with('fail', ' You roll a ' . $num . ', you lose $' . number_format($bet) . '.');
        } else {

            if ($object->cash < $bet) { //sweeped
                $object->owner = $user->id;
                $user->cash+= $object->cash;
                $object->cash = 0;
                $object->maxbet = 0;
                $object->profit = 0;
                MessageController::sendSystemMessage($owner->name, "55x2 ".$location->name." has been overtaken by ".$user->name."!",
                    "You didn't have enough cash in your object to pay out the profits.");
                $user->save();
                $object->save();

                return redirect('55x2')->with('neutral', 'The 55x2 did not have enough cash to pay out your profits, you have overtaken the object!');
            }

            $user->cash+=$bet;
            $object->cash-=$bet;
            $object->profit-=$bet;
            $object->save();
            $user->save();
            return redirect('55x2')->with('success', ' You roll a ' . $num . ', you win $' . number_format($bet) . '!');
        }
    }

    public function spinRoulette(Request $request) {
        $num = rand(1, 15);
        $user = Auth::user();
        $red = $request['red_amount'];
        $location = Location::where('id', $user->location)->get()->first();
        $object = Object::where('location', $user->location)->where('type', 0)->get()->first();
        $owner = User::where('id', $object->owner)->get()->first();

        if ($red == null)
            $red = 0;

        $black = $request['black_amount'];
        if ($black == null)
            $black = 0;

        $green = $request['green_amount'];
        if ($green == null)
            $green = 0;

        $bet = $red+$black+$green;

        if ($bet < 1) {
            return redirect('roulette')->with('fail', 'Invalid bet.');
        }

        if ($bet > $object->maxbet) {
            return redirect('roulette')->with('fail', 'You can not place a bet higher than the maximum bet.');
        }

        if ($bet > $user->highestbet)
        {
            $user->highestbet = $bet;
        }

        $user->cash -= $bet;

        $profit = 0;
        $color = 'white';

        if ($num == 1 ) {

            if ($green > 0)
                $profit += ($green * 14);

            $color="green";
        }
        if ($num >= 2 && $num <= 8) {

            if ($red > 0)
                $profit += ($red * 2);

            $color="red";
        }
        if ($num >= 9 && $num <= 15) {

            if ($black > 0)
                $profit += ($black * 2);

            $color="black";
        }

        //object bank interaction

        if ($object->cash < $profit-$bet) { //sweeped
            $object->owner = $user->id;
            $user->cash+= $object->cash;
            $object->cash = 0;
            $object->maxbet = 0;
            $object->profit = 0;
            MessageController::sendSystemMessage($owner->name, "Roulette ".$location->name." has been overtaken by ".$user->name."!",
                "You didn't have enough cash in your object to pay out the profits.");
            $user->save();
            $object->save();

            return redirect('roulette')->with('neutral', 'The roulette did not have enough cash to pay out your profits, you have overtaken the object!');
        }

        $user->cash+=$profit;
        $object->cash -= $profit-$bet;
        $object->profit -= $profit-$bet;
        $user->save();
        $object->save();

        return redirect('roulette')
            ->with('roulette-result', $num)
            ->with('roulette-color', $color)
            ->with('roulette-profit', $profit-$bet);

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
