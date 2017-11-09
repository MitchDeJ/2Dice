<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Location;

class GamblingController extends Controller
{
    /**
     * Show the application 55x45 overview.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('55x2', array("user" => Auth::user()));
    }

    /**
     * Show the application coinflip overview.
     *
     * @return \Illuminate\Http\Response
     */
    public function coinflip()
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
    public function roulette()
    {
        $user = Auth::user();
        return view('roulette', array(
            "user" => $user,
            "location" => Location::where("id", $user->location)->get()->first()
        ));
    }

    /**
     * Show the application blackjack overview.
     *
     * @return \Illuminate\Http\Response
     */
    public function blackjack()
    {
        $user = Auth::user();
        return view('blackjack', array(
            "user" => $user,
            "location" => Location::where("id", $user->location)->get()->first()
        ));
    }
}
