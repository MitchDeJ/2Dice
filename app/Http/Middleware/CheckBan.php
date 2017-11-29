<?php

namespace App\Http\Middleware;

use Closure;
use App\Ban;
use Auth;

class CheckBan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user() != null && $next) {
            $bans = Ban::where('user', Auth::user()->id)->get();
            if ($bans->count() > 0) {
                Auth::logout();
                return redirect("/login")->with("ban", $bans->first()->reason);
            }
        }
        return $next($request);
    }
}
