<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Location;
use App\MarketOffer;

class MarketplaceController extends Controller
{
    /**
     * Show the application marketplace overview.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('marketplace', array("user" => Auth::user()));
    }

    public function createOffer(Request $request)
    {
        $creator = $request->input('creator');
        $creatortype = $request->input('creatortype');
        $offertype = $request->input('offertype');
        $item = $request->input('item');
        $price = $request->input('price');
        $amount = $request->input('amount');
        $completed = 0;
        $location = $request->input('location');
        $cash = 0;


        if ($creatortype == 0) {  //if listed by a user

            $user = User::where('id', $creator);

            /*
             * Buy offer
             */
            if ($offertype == 0) {

                if ($user->cash < $amount * $price)
                    return redirect('marketplace');//TODO niet genoeg geld

                $user->cash -= $amount * $price;
                $cash = $amount * $price;

                $matches = MarketOffer::where('item', $item)
                    ->where('cancelled', false)
                    ->where('location', $location)
                    ->where('price', '<=', $price)
                    ->where('offertype', 1)
                    ->sortBy('price');

                foreach ($matches as $match) {

                    if ($completed >= $amount)
                        break;

                    if (!$match->amount == $match->completed) {
                        $available = $match->amount - $match->completed;
                        $needed = ($amount - $completed);
                        if ($needed >= $available) {
                            $completed += $available;
                            $match->completed += $available;
                            $cash -= ($available * $match->price);
                            $match->cash += ($available * $match->price);
                        } else {
                            $completed += $needed;
                            $match->completed += $needed;
                            $cash -= ($needed * $match->price);
                            $match->cash += ($needed * $match->price);
                        }
                        $match->save();
                    }
                }

                /*
                 * sell offer
                 */
            } else if ($offertype == 1) {

                if (!$this->hasItem($user, $item, $amount))
                    return redirect('marketplace');//TODO niet genoeg resources

                $this->removeItem($user, $item, $amount);

                $matches = MarketOffer::where('item', $item)
                    ->where('cancelled', false)
                    ->where('location', $location)
                    ->where('price', '>=', $price)
                    ->where('offertype', 0)
                    ->sortByDesc('price');

                foreach ($matches as $match) {

                    if ($completed >= $amount)
                        break;
                    if (!$match->amount == $match->completed) {
                        $needed = $match->amount - $match->completed;
                        $available = $amount - $completed;
                        if ($needed >= $available) {
                            $match->completed += $available;
                            $completed += $available;
                            $cash += ($match->price * $available);
                            $match->cash -= ($match->price * $available);
                        } else {
                            $match->completed += $needed;
                            $completed += needed;
                            $cash += ($match->price * $needed);
                            $match->cash -= ($match->price * needed);
                        }
                        $match->save();
                    }
                }
            }

            //all matches have been applied, saving the offer into the database.
            $offer = MarketOffer::create([
                'creator' => $creator,
                'creatortype' => $creatortype,
                'offertype' => $offertype,
                'item' => $item,
                'price' => $price,
                'amount' => $amount,
                'completed' => $completed,
                'collected' => 0,
                'location' => $location,
                'cash' => $cash,
                'cancelled' => false
            ]);
            $offer->save();
        }
    }

    public function cancelOffer(Request $request)
    {
        $offer = MarketOffer::where('id', $request->input('id'));

        if ($offer->amount == $offer->completed)
            return redirect('marketplace');//already completed, collect pls

        $offer->cancelled = true;
        $offer->save();
        return redirect('marketplace');//TODO cancelled offer msg
    }

    public function collectOffer(Request $request)
    {
        $offer = MarketOffer::where('id', $request->input('id'));
        $toCollect = $offer->completed - $offer->collected;

        if ($offer->creatortype == 0) {// user offer

            $user = User::where('id', $offer->creator);

            if ($offer->offertype == 0) { //buy offer

                if ($offer->cancelled == false && $toCollect <= 0)
                    return redirect('marketplace');//TODO nothing to collect

                $this->addItem($user, $offer->item, $offer->toCollect);
                $offer->collected += $toCollect;
                if ($offer->cancelled == true) {
                    $user->cash += $offer->cash;
                    $offer->delete();
                    return redirect('marketplace');//TODO msg offer removed & collected
                } else {
                    return redirect('marketplace');// msg collected stuff
                }

            } else if ($offer->offertype == 1) { // sell offer

                if ($offer->cancelled == false && $toCollect <= 0)
                    return redirect('marketplace');//TODO nothing to collect

                $user->cash += $offer->cash;
                $offer->cash = 0;
                $offer->collected += $toCollect;
                if ($offer->cancelled == true) {
                    $this->addItem($user, $offer->item, $offer->amount - $offer->completed);
                    $offer->delete();
                    return redirect('marketplace');//TODO msg offer removed & collected
                } else {
                    return redirect('marketplace');// msg collected stuff
                }
            }
        }

        if ($offer->creatortype == 1) { // company offer
            //
        }

    }


public
function hasItem(User $user, $item, $amount)
{
    switch ($item) {
        case 0://wood
            return $user->wood >= $amount;
        case 1://stone
            return $user->stone >= $amount;
        case 2://wheat
            return $user->wheat >= $amount;
    }
}

public
function removeItem(User $user, $item, $amount)
{
    switch ($item) {
        case 0://wood
            $user->wood -= $amount;
            break;
        case 1://stone
            $user->stone -= $amount;
            break;
        case 2://wheat
            $user->wheat -= $amount;
            break;
    }
    $user->save();
}

public
function addItem(User $user, $item, $amount)
{
    switch ($item) {
        case 0://wood
            $user->wood += $amount;
            break;
        case 1://stone
            $user->stone += $amount;
            break;
        case 2://wheat
            $user->wheat += $amount;
            break;
    }
    $user->save();
}
}
