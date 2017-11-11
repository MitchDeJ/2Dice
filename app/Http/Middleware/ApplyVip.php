<?php

namespace App\Http\Middleware;

use Closure;
use App\Subscription;
use Auth;

class ApplyVip
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        $subscribed = Subscription::where('user', Auth::user()->id)->get()->count();
        if ($subscribed != 0) {
            $subscription = Subscription::where('user', Auth::user()->id)->get()->first();
            if (time() > $subscription->end) {
                Auth::user()->vip = false;
                Auth::user()->save();
                $subscription->delete();
            } else {
                Auth::user()->vip = true;
                Auth::user()->save();
            }
        } else {
            Auth::user()->vip = false;
            Auth::user()->save();
        }
        return $next($request);
    }
}
