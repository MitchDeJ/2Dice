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
}
