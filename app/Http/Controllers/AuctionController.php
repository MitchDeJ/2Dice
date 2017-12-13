<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Object;
use App\User;
use App\Auction;

class AuctionController extends Controller
{

    /**
     * Show the application auction view.
     *
     * @return \Illuminate\Http\Response
     */
    public function newAuction()
    {
        $user = Auth::user();
        $objects = Object::where('owner', $user->id)->get();
        $list = "";
        foreach ($objects as $obj) {
            $list .= ObjectController::getTypeName($obj->type) . ' ' . LocationController::getName($obj->location) . ', ';
        }
        $list = substr($list, 0, strlen($list) - 2);


        if ($list == "")
            return redirect('marketplace')->with('neutral', 'You do not own any objects.');

        $options = explode(', ', $list);
        $values = array();
        $types = 4;
        $locs = 3;
        for ($i = 0; $i < sizeof($options); $i++) {
            $val = '';
            for ($t = 0; $t < $types; $t++) {
                if (strpos($options[$i], ObjectController::getTypeName($t)) !== false) {
                    $val .= $t;
                }
            }
            for ($l = 1; $l <= $locs; $l++) {
                if (strpos($options[$i], LocationController::getName($l)) !== false) {
                    $val .= $l;
                }
            }

            $values[$i] = $val;
        }

        $optionlist = array();

        for ($o = 0; $o < sizeof($options); $o++) {
            $optionlist[$values[$o]] = $options[$o];
        }


        return view('newauction', array(
            "user" => Auth::user(),
            "optionlist" => $optionlist,
        ));
    }

    public function addAuction(Request $request)
    {
        $user = Auth::user();
        $object = Object::where('type', substr($request->input('object'), 0, 1))->where('location', substr($request->input('object'), 1, 1))->get();
        $minprice = $request->input('minprice');
        $hours = $request->input('time');

        $UNIXHOUR = 3600;

        $auctions = Auction::all();

        foreach ($auctions as $auction) {
            if ($auction->location == substr($request->input('object'), 1, 1)
                && $auction->type == substr($request->input('object'), 0, 1)
            ) {
                return redirect('newauction')->with('fail', 'This object is already up for auction.');
            }
        }

        if ($hours < 1) {
            return redirect('newauction')->with('fail', 'Invalid time.');
        }

        if ($hours > 24) {
            return redirect('newauction')->with('fail', 'You can put up an auction for a maximum of 24 hours.');
        }

        if ($minprice < 1) {
            return redirect('newauction')->with('fail', 'Invalid minimum price.');
        }

        if ($minprice > config('app.maxcash'))
            return redirect('newauction')->with('fail', 'Invalid amount.');

        if ($object->count() < 1) {
            return redirect('newauction')->with('fail', 'Invalid object.');
        }


        $object = $object->first();

        if ($object->owner != $user->id) {
            return redirect('newauction')->with('fail', 'You do not own that object.');
        }


        $user->cash += $object->cash;
        $object->cash = 0;
        $object->maxbet = 0;
        $object->save();
        $user->save();

        Auction::create([
            'user' => $user->id,
            'type' => substr($request->input('object'), 0, 1),
            'location' => substr($request->input('object'), 1, 1),
            'minprice' => $minprice,
            'biduser' => 0,
            'bid' => 0,
            'end' => (time() + ($hours * $UNIXHOUR))
        ]);

        return redirect('marketplace')->with('marketplace', 'Auction listed.');
    }

    public function bid(Request $request)
    {
        $user = Auth::user();
        $amount = $request->input('amount');
        $auction = Auction::where('id', $request->input('id'))->get()->first();
        $oldbidder = User::where('id', $auction->biduser)->get()->first();

        if ($auction->end < time()) {
            return redirect('marketplace')->with('fail', 'Too late!');
        }

        if ($amount < 1) {
            return redirect('marketplace')->with('fail', 'Invalid amount.');
        }

        if ($oldbidder != null) {
            if ($user->id == $oldbidder->id) {
                if ($amount > ($user->cash + $auction->bid)) {
                    return redirect('marketplace')->with('fail', 'You do not have that much cash.');
                }
            } else {
                if ($amount > $user->cash) {
                    return redirect('marketplace')->with('fail', 'You do not have that much cash.');
                }
            }
        } else {
            if ($amount > $user->cash) {
                return redirect('marketplace')->with('fail', 'You do not have that much cash.');
            }
        }

        if ($user->id == $auction->user) {
            return redirect('marketplace')->with('fail', 'Your can not bid for your own auction.');
        }

        if ($amount <= $auction->bid) {
            return redirect('marketplace')->with('fail', 'Your bid has to be higher than the current highest bid.');
        }

        if ($amount < $auction->minprice) {
            return redirect('marketplace')->with('fail', 'Your bid can not be lower than the minimum price.');
        }

        if ($auction->biduser != 0) {
            //refund other bid
            if ($oldbidder->id == $user->id) {
                $user->cash+= $auction->bid;
            } else {
                $oldbidder->cash += $auction->bid;
                $oldbidder->save();
            }
            if (!($oldbidder->id == $user->id)) {
                MessageController::sendSystemMessage($oldbidder->name,
                    "You have been overbidden!",
                    "Your bid for " . ObjectController::getTypeName($auction->type) . " " . LocationController::getName($auction->location) . " ($" . number_format($auction->bid) . ")" . " has been returned."
                );
            }
        }
        // set new bid
        $user->cash -= $amount;
        $auction->bid = $amount;
        $auction->biduser = $user->id;
        $auction->save();
        $user->save();;
        return redirect('marketplace')->with('success', 'Your bid has been placed.');
    }

    public static function endAuction($id) {
        $auction = Auction::where('id', $id)->get()->first();
        $seller = User::where('id', $auction->user)->get()->first();
        $winner = User::where('id', $auction->biduser)->get()->first();
        $object = Object::where('type', $auction->type)->where('location', $auction->location)->get()->first();

        if ($auction->biduser == 0 || $auction->bid == 0) {
            MessageController::sendSystemMessage($seller->name,
                "Your auction for ".ObjectController::getTypeName($auction->type)." ".LocationController::getName($auction->location)." has ended.",
                "Nobody placed a bid, this means the object is still owned by you. You can put it up for auction again if you would like to. "
            );
        } else {

            //give seller his cash
            $seller->cash += $auction->bid;
            $seller->save();
            MessageController::sendSystemMessage($seller->name,
                "Your auction for " . ObjectController::getTypeName($auction->type) . " " . LocationController::getName($auction->location) . " has ended.",
                "It was sold to " . $winner->name . " for $" . number_format($auction->bid) . "."
            );

            //give auction winner the object.
            $object->owner = $winner->id;
            $object->profit = 0;
            $object->cash = 0;
            $object->maxbet = 0;
            $object->save();
            MessageController::sendSystemMessage($winner->name,
                "You won the auction for " . ObjectController::getTypeName($auction->type) . " " . LocationController::getName($auction->location) . "!",
                "You are now the owner of this object."
            );

        }
        $auction->delete();

    }
}
