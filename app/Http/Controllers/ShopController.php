<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ShopController extends Controller
{
    /**
     * Show the application general store overview.
     *
     * @return \Illuminate\Http\Response
     */
    public function general()
    {
        return view('general', array("user" => Auth::user()));
    }

    /**
     * Show the application prestige store overview.
     *
     * @return \Illuminate\Http\Response
     */
    public function prestige()
    {
        return view('prestige', array("user" => Auth::user()));
    }

    public function buyPower(Request $request) {
        $amount = $request->input('amount');
        $price = $amount*100;
        $user = Auth::user();

        if ($amount < 1)
            return redirect('general')->with('fail', 'Invalid amount.');
        if ($user->cash < $price)
            return redirect('general')->with('fail', 'You do not have enough cash to buy '.number_format($amount).' power.');

        $user->cash -= $price;
        $user->power += $amount;
        $user->save();
        return redirect('general')->with('success', 'Successfully bought '.number_format($amount).' power for $'.number_format($price));
    }

    public function claimPower(Request $request) {
        $amount = $request->input('amount');
        $user = Auth::user();

        $POWER = 75000;

        if ($amount < 1)
            return redirect('prestige')->with('fail', 'Invalid amount.');
        if ($user->prestigepoints < $amount)
            return redirect('prestige')->with('fail', 'You do not have enough prestige points to claim '.$amount.'x '.number_format($POWER).' power.');

        $user->prestigepoints -= $amount;
        $user->power += $amount*$POWER;
        $user->save();
        return redirect('prestige')->with('success', 'Successfully claimed '.number_format($POWER*$amount).' power for '.number_format($amount).' prestige points.');
    }

    public function claimCash(Request $request) {
        $amount = $request->input('amount');
        $user = Auth::user();

        $CASH = 5000000;

        if ($amount < 1)
            return redirect('prestige')->with('fail', 'Invalid amount.');
        if ($user->prestigepoints < $amount)
            return redirect('prestige')->with('fail', 'You do not have enough prestige points to claim '.$amount.'x $'.number_format($CASH).'.');

        $user->prestigepoints -= $amount;
        $user->cash += $amount*$CASH;
        $user->save();
        return redirect('prestige')->with('success', 'Successfully claimed $'.number_format($CASH*$amount).' for '.number_format($amount).' prestige points.');
    }
}
