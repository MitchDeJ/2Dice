<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
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
        $user = Auth::user();
        $offers = MarketOffer::where('creator', $user->id)->get();
        $itemnames = collect(["Wood", "Stone", "Wheat"]);
        return view('marketplace', array(
            "user" => $user,
            "offers" => $offers,
            'itemnames' => $itemnames
        ));
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
        $cash = 0;

        if ($creatortype == 0) {  //if listed by a user

            $user = User::where('id', $creator)->get()->first();
            $useroffers = MarketOffer::where('creator', $user->id)->where('creatortype', 0)->get()->count();
            $limit = 3;

            if ($user->vip == true)
                $limit = 6;

            if ($useroffers == $limit)
                return redirect('marketplace')->with('fail', 'You have reached the '.$limit.' offer limit.');

            /*
             * Buy offer
             */
            if ($offertype == 0) {

                if ($user->cash < $amount * $price)
                    return redirect('newoffer')->with('fail', 'You do not have enough cash to create that offer.');

                $user->cash -= $amount * $price;
                $cash = $amount * $price;

                $userMatches = MarketOffer::where('item', $item)
                    ->where('creatortype', 0)
                    ->where('creator', '!=', $user->id)
                    ->where('cancelled', false)
                    ->where('price', '<=', $price)
                    ->where('offertype', 1)
                    ->get()
                    ->sortBy('price');

                $companyMatches =  MarketOffer::where('item', $item)
                    ->where('creatortype', 1)
                    ->where('creator', '!=', $user->company)
                    ->where('cancelled', false)
                    ->where('price', '<=', $price)
                    ->where('offertype', 1)
                    ->get()
                    ->sortBy('price');

                $matches = $userMatches->merge($companyMatches);

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
                        $user->save();
                        $match->save();
                    }
                }
                $user->save();

                /*
                 * sell offer
                 */
            } else if ($offertype == 1) {

                if (!$this->hasItem($user, $item, $amount))
                    return redirect('newoffer')->with('fail', 'You do not have the required resources to create that offer.');

                $this->removeItem($user, $item, $amount);

                $matches = MarketOffer::where('item', $item)
                    ->where('cancelled', false)
                    ->where('price', '>=', $price)
                    ->where('offertype', 0)
                    ->get()
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
                            $cash += ($price * $available);
                            $match->cash -= ($price * $available);
                        } else {
                            $match->completed += $needed;
                            $completed += $needed;
                            $cash += ($price * $needed);
                            $match->cash -= ($price * $needed);
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
                'cash' => $cash,
                'cancelled' => false
            ]);
            $offer->save();

            return redirect('marketplace')->with('success', 'Offer created.');
        }
    }

    public function cancelOffer(Request $request)
    {
        $offer = MarketOffer::where('id', $request->input('id'))->get()->first();;

        if ($offer->amount == $offer->completed)
            return redirect('marketplace')->with('neutral', 'Offer has already been completed, please collect.');

        $offer->cancelled = true;
        $offer->save();
        return redirect('marketplace')->with('success', 'Offer cancelled.');
    }

    public function collectOffer(Request $request)
    {
        $offer = MarketOffer::where('id', $request->input('id'))->get()->first();
        $toCollect = $offer->completed - $offer->collected;

        if ($offer->creatortype == 0) {// user offer

            $user = Auth::user();

            if ($offer->offertype == 0) { //buy offer

                if ($offer->cancelled == false && $toCollect <= 0)
                    return redirect('marketplace')->with('fail', 'The collection box of this offer is currently empty.');

                $this->addItem($user, $offer->item, $toCollect);
                $offer->collected += $toCollect;
                $offer->save();
                if ($offer->cancelled == true || $offer->amount == $offer->completed) {
                    $cash = $offer->cash;
                    $user->cash += $cash;
                    $user->save();
                    $offer->delete();
                    if ($cash > 0)
                        return redirect('marketplace')->with('success', 'Collected '.number_format($toCollect).' items and $'.number_format($cash).'. The offer has been removed.');
                    else
                        return redirect('marketplace')->with('success', 'Collected '.number_format($toCollect).' items. The offer has been removed.');
                } else {
                    return redirect('marketplace')->with('success', 'Collected '.number_format($toCollect).' items.');
                }

            } else if ($offer->offertype == 1) { // sell offer

                if ($offer->cancelled == false && $toCollect <= 0)
                    return redirect('marketplace')->with('fail', 'The collection box of this offer is currently empty.');

                $cash = $offer->cash;
                $user->cash += $cash;
                $offer->cash = 0;
                $user->save();
                $offer->save();
                $offer->collected += $toCollect;
                if ($offer->cancelled == true || $offer->amount == $offer->completed) {
                    $this->addItem($user, $offer->item, $offer->amount - $offer->completed);
                    $offer->delete();
                    if ($offer->amount - $offer->completed > 0)
                        return redirect('marketplace')->with('success', 'Collected '.number_format($offer->amount - $offer->completed).' items and $'.number_format($cash).'. The offer has been removed.');
                    else
                        return redirect('marketplace')->with('success', 'Collected $'.number_format($cash).'. The offer has been removed.');
                } else {
                    return redirect('marketplace')->with('success', 'Collected $'.number_format($cash).'.');
                }
            }
        }

        if ($offer->creatortype == 1) { // company offer
            //
        }

    }


    public function hasItem(User $user, $item, $amount)
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

    public function removeItem(User $user, $item, $amount)
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

    public function addItem(User $user, $item, $amount)
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

    /**
     * Show the application marketplace create offer.
     *
     * @return \Illuminate\Http\Response
     */
    public function newOffer()
    {
        return view('newoffer', array("user" => Auth::user()));
    }
}
