<?php

namespace App\Http\Middleware;

use App\Auction;
use App\Http\Controllers\AuctionController;
use Closure;

class CheckAuctions
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
        $auctions = Auction::all();
        foreach ($auctions as $a) {
            if ($a->end < time()) {
                AuctionController::endAuction($a->id);
            }
        }

        return $next($request);
    }
}
