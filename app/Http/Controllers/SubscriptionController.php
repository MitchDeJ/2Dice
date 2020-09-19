<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscription;
use App\User;
use App\Code;
use Auth;

class SubscriptionController extends Controller
{
//2592000 adding a month
//604800  adding a week
//86400   adding a day
public static function addSubscription($username, $length) {
        $user = User::where('name', $username)->get()->first();
        $subscribed = Subscription::where('user', $user->id)->get()->count();
        //adding to another subscription
        if ($subscribed == 1) {
            $subscription = Subscription::where('user', $user->id)->get()->first();
            $subscription->end += $length;
            $subscription->save();
        } else if ($subscribed == 0) { //new subscription
            $subscription = Subscription::create([
                'user' => $user->id,
                'start' => time(),
                'end' => time()+$length,
            ]);
            $subscription->save();
        }
    }

    public function redeem(Request $request) {
        $user = Auth::user();
        $name = $user->name;
        $code = $request->input('code');

        $dbCode = Code::where('code', $code)->get();

        if (!$dbCode->first()) {
            return redirect('vip')->with('fail', 'Invalid code.');
        }

        $dbCode = $dbCode->first();

        if ($dbCode->used == true) {
            return redirect('vip')->with('fail', 'This code already has been used.');
        }

        $UNIXDAY = 60 * 60 * 24;
        $days = 30;
        self::addSubscription($name, $days * $UNIXDAY);
        $dbCode->used = true;
        $dbCode->user = $user->id;
        $dbCode->save();
        return redirect('vip')->with('success', 'Your code has been successfully redeemed. '.$days.' days of VIP have been added to your account.');
    }
}
