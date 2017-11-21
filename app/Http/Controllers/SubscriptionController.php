<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscription;
use App\User;

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
}
