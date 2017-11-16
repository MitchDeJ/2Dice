<?php

namespace App\Http\Controllers;

use App\User;
use App\Object;
use App\BlackjackTurn;
use Illuminate\Http\Request;
use Auth;
use App\Location;

class BlackjackController extends Controller
{
    //blackjack is such a big game, it gets its own controller instead of gamblingcontroller


    /*show index*/

    /**
     * Show the application blackjack overview.
     *
     * @return \Illuminate\Http\Response
     */
    public function blackjackIndex()
    {
        $user = Auth::user();
        $location = Location::where("id", $user->location)->get()->first();

        $object = Object::where('location', $location->id)->where('type', 1)->get()->first();

        $state = BlackjackController::getGameState($user, $location->id);
        $turns = BlackjackTurn::where('user', $user->id)->where('location', $location->id)->get();
        $userTotal = 0;
        $cpuTotal = 0;
        $hideCard = -1;

        if ($turns->count() > 0)
            $bet = $turns->first()->bet;
        else
            $bet = 0;

        /*adding up totals, one card hidden for cpu if game going*/
        foreach ($turns as $t) {
            $userTotal += BlackjackController::getCardValue($t->usercard, $userTotal);
            if ($state != "ONGOING")
                $cpuTotal += BlackjackController::getCardValue($t->cpucard, $cpuTotal);
        }

        if ($state == "ONGOING") {
            for ($i = 0; $i < $turns->count() - 1; $i++) {
                if ($turns[$i+1]->cpucard != 0)
                    $cpuTotal += BlackjackController::getCardValue($turns[$i]->cpucard, $cpuTotal);
            }
        }

        /*getting cards to display*/
        $userCards = array();
        $cpuCards = array();

        for ($i = 0; $i < $turns->count(); $i++) {
            $userCards[$i] = "img/cards/card" .
                BlackjackController::getCardType($turns[$i]->usercardtype) .
                BlackjackController::getCardName($turns[$i]->usercard) .
                '.png';
            $cpuCards[$i] = "img/cards/card" .
                BlackjackController::getCardType($turns[$i]->cpucardtype) .
                BlackjackController::getCardName($turns[$i]->cpucard) .
                '.png';

            if ($state == "ONGOING" && $hideCard == -1) {
                if ($turns[$i]->cpucard == 0)
                $hideCard = $i - 1;
                else
                    $hideCard = $turns->count()-1;
            }


            if ($turns->count() == 2) {
                $hideCard = 1;
            }
        }

        if (User::where('id', $object->owner)->get()->count() < 1)
            $owner = null;
        else
            $owner = User::where('id', $object->owner)->get()->first();

        return view('blackjack', array(
            "user" => $user,
            "location" => $location,
            "object" => $object,
            "owner" => $owner,
            "state" => $state,
            "bet" => $bet,
            "usercards" => $userCards,
            "cpucards" => $cpuCards,
            "turncount" => $turns->count(),
            "cputotal" => $cpuTotal,
            "usertotal" => $userTotal,
            "hidecard" => $hideCard
        ));
    }

    /*blackjack cards*/

    public static function getCardType($type) {
        switch($type) {
            case 0:
                return "Clubs";
            case 1:
                return "Diamonds";
            case 2:
                return "Hearts";
            case 3:
                return "Spades";
        }
    }

    public static function getCardName($card)
    {
        switch ($card) {
            case 2:
            case 3:
            case 4:
            case 5:
            case 6:
            case 7:
            case 8:
            case 9:
            case 10:
                return "" . $card;

            case 11: //ace
                return "A";
            case 12: // j
                return "J";
            case 13:
                return "K";
            case 14:
                return "Q";

        }
    }

    public static function getCardValue($card, $currenttotal) {
        switch ($card) {
            case 0: return 0;
            case 2:
            case 3:
            case 4:
            case 5:
            case 6:
            case 7:
            case 8:
            case 9:
            case 10:
                return $card;

            case 11: //ace
                if ($currenttotal  <= 10)
                    return 11;
                else
                    return 1;
            case 12: // j
                return 10;
            case 13:
                return 10;
            case 14:
                return 10;

        }
    }

    /*blackjack game*/

    public function startBlackjack(Request $request) {
        //input
        $bet = $request->input('bet');
        $location = $request->input('location');

        $user = Auth::user();

        if ($bet < 1)
        {
            return redirect('blackjack')->with('fail', 'Invalid bet.');
        }

        //getting the object
        $object = Object::where('type', 1)->where('location', $location)->get()->first();

        if ($bet > $object->maxbet) {
            return redirect('blackjack')->with('fail', 'You can not place a bet higher than the maximum bet.');
        }

        //inserting two turns to start off
        $turn1 = BlackjackTurn::create ([
            'user' => $user->id,
            'location' => $location,
            'usercardtype' => rand(0, 3),
            'usercard' => rand(2, 14),
            'cpucardtype' => rand(0, 3),
            'cpucard' => rand(2, 14),
            'bet' => $bet,
            'stand' => false
        ]);
        $turn2 = BlackjackTurn::create ([
            'user' => $user->id,
            'location' => $location,
            'usercardtype' => rand(0, 3),
            'usercard' => rand(2, 14),
            'cpucardtype' => rand(0, 3),
            'cpucard' => rand(2, 14),
            'bet' => $bet,
            'stand' => false
        ]);

        $user->cash -= $bet;
        $user->save();

        $this->checkBlackJack($user, $location);
        return redirect('blackjack');
    }

    public function hitBlackJack(Request $request) {

        $user = Auth::user();
        $location = $request->input('location');

        $turns = BlackjackTurn::where('user', $user->id)->where('location', $location)->get();
        $bet = $turns->first()->bet;
        $turncount = $turns->count();
        $stand = false;

        $userTotal = 0;
        $cpuTotal = 0;

        foreach($turns as $t) {
            $userTotal += BlackjackController::getCardValue($t->usercard, $userTotal);
            $cpuTotal += BlackjackController::getCardValue($t->cpucard, $cpuTotal);
            if ($t->stand == true)
                $stand = true;
        }

        //checking if we haven't already lost

        if ($userTotal > 21) {
            return redirect('blackjack')->with('fail', 'You have already lost this game, please start a new game.');
        }

        if ($turncount == 2 && $cpuTotal == 21) {
            return redirect('blackjack')->with('fail', 'You have already lost this game, please start a new game.');
        }

        //checking if we haven't already won

        if ($cpuTotal > 21 && $userTotal <= 21) { //cpu bust
            return redirect('blackjack')->with('fail', 'You have already won this game, please start a new game.');
        }

        if ($turncount == 2 && $userTotal == 21) { //user instant blackjack
            return redirect('blackjack')->with('fail', 'You have already won this game, please start a new game.');
        }

        //checking if stand has already been used

        if ($stand == true) {
            return redirect('blackjack')->with('fail', 'This game is already over. please start a new game.');
        }


        /*will the cpu hit?*/
        if ($cpuTotal > 16) {
            $cpuCard = 0;
        } else {
            $cpuCard = rand(2, 14);
        }

        BlackjackTurn::create ([
            'user' => $user->id,
            'location' => $location,
            'usercardtype' => rand(0, 3),
            'usercard' => rand(2, 14),
            'cpucardtype' => rand(0, 3),
            'cpucard' => $cpuCard,
            'bet' => $bet,
            'stand' => false
        ]);

        $this->checkBlackJack($user, $location);

        return redirect('blackjack');
    }

    public function standBlackJack(Request $request) {

        $user = Auth::user();
        $location = $request->input('location');

        $turns = BlackjackTurn::where('user', $user->id)->where('location', $location)->get();
        $bet = $turns->first()->bet;
        $turncount = $turns->count();
        $stand = false;

        $userTotal = 0;
        $cpuTotal = 0;

        foreach($turns as $t) {
            $userTotal += BlackjackController::getCardValue($t->usercard, $userTotal);
            $cpuTotal += BlackjackController::getCardValue($t->cpucard, $cpuTotal);
            if ($t->stand == true)
                $stand = true;
        }

        //checking if we haven't already lost

        if ($userTotal > 21) {
            return redirect('blackjack')->with('fail', 'You have already lost this game, please start a new game.');
        }

        if ($turncount == 2 && $cpuTotal == 21) {
            return redirect('blackjack')->with('fail', 'You have already lost this game, please start a new game.');
        }

        //checking if we haven't already won

        if ($cpuTotal > 21 && $userTotal <= 21) { //cpu bust
            return redirect('blackjack')->with('fail', 'You have already won this game, please start a new game.');
        }

        if ($turncount == 2 && $userTotal == 21) { //user instant blackjack
            return redirect('blackjack')->with('fail', 'You have already won this game, please start a new game.');
        }

        if ($stand == true) {
            return redirect('blackjack')->with('fail', 'This game is already over, please start a new game.');
        }

        while($cpuTotal <= 16) { //let cpu take cards
            if($cpuTotal > $userTotal)
                break;
            $cpuCard = rand(2, 14);
            $cpuCardVal = BlackjackController::getCardValue($cpuCard, $cpuTotal);
            BlackjackTurn::create ([
                'user' => $user->id,
                'location' => $location,
                'usercardtype' => rand(0, 3),
                'usercard' => 0,
                'cpucardtype' => rand(0, 3),
                'cpucard' => $cpuCard,
                'bet' => $bet,
                'stand' => true
            ]);
            $cpuTotal += $cpuCardVal;
        }

        $turns = BlackjackTurn::where('user', $user->id)->where('location', $location)->get();
        $turns->last()->stand = true;
        $turns->last()->save();

        $this->checkBlackJack($user, $location);
        return redirect('blackjack');
    }

    public function checkBlackJack(User $user, $location) {
        $state = BlackjackController::getGameState($user, $location);

        $object = Object::where('type', 1)->where('location', $location)->get()->first();
        $owner = User::where('id', $object->owner)->get()->first();

        $turns = BlackjackTurn::where('user', $user->id)->where('location', $location)->get();
        $bet = $turns->first()->bet;

        if ($state == "WIN") {

            if ($object->cash < $bet) {
                // give object to better
                $object->owner = $user->id;
                $user->cash+= $object->cash;
                $object->cash = 0;
                $object->maxbet = 0;
                $object->profit = 0;
                MessageController::sendSystemMessage($owner->name, "Blackjack ".$location->name." has been overtaken by ".$user->name."!",
                    "You didn't have enough cash in your object to pay out the profits.");
            } else {
                $user->cash+=($bet*2);
                $object->cash-=($bet);
                $object->profit-=($bet);
            }
        } else if ($state == "LOSE") {
            $object->cash += $bet;
            $object->profit += $bet;
        } else if ($state == "DRAW") {
            $user->cash += $bet;
        } else if ($state == "WIN_BLACKJACK") {

            if ($object->cash < $bet*1.5) {
                // give object to better
                $object->owner = $user->id;
                $user->cash+= $object->cash;
                $object->cash = 0;
                $object->maxbet = 0;
                $object->profit = 0;
                MessageController::sendSystemMessage($owner->name, "Blackjack ".$location->name." has been overtaken by ".$user->name."!",
                    "You didn't have enough cash in your object to pay out the profits.");
            } else {
                $user->cash += ($bet * 2.5);
                $object->cash -= ($bet * 1.5);
                $object->profit -= ($bet * 1.5);
            }
        }

        $user->save();
        $object->save();
    }

    public static function resetBlackJack(Request $request) {
        $user = Auth::user();
        $location = $request->input('location');
        $turns = BlackjackTurn::where('user', $user->id)->where('location', $location)->get();

        foreach ($turns as $turn) {
            $turn->delete();
        }
        return redirect('blackjack');
    }

    public static function getGameState(User $user, $location) {

        $turns = BlackjackTurn::where('user', $user->id)->where('location', $location)->get();
        $stand = false;
        $turncount = $turns->count();

        $userTotal = 0;
        $cpuTotal = 0;

        $stand = false;

        foreach($turns as $t) {
            $userTotal += BlackjackController::getCardValue($t->usercard, $userTotal);
            $cpuTotal += BlackjackController::getCardValue($t->cpucard, $cpuTotal);
            if ($t->stand == true)
                $stand = true;
        }

        if ($turncount == 0) {
            return "NEW";
        }

        if ($stand) {
            if ($cpuTotal > 21)  // CPU bust!
                return "WIN";

            if ($userTotal > 21)  // user bust in a stand? not possible?
                return "LOSE";

            //both didnt bust
            if ($cpuTotal == $userTotal)  // its a draw!
                return "DRAW";

            if ($cpuTotal > $userTotal)  //user lost
                return "LOSE";

            if ($cpuTotal < $userTotal)  //user won
                return "WIN";

        } else {
            if ($userTotal > 21) {  //user bust
                return "LOSE";
        }

        if ($turncount == 2 && $cpuTotal == 21 && $userTotal == 21) {
                return "DRAW";
        }

        if ($userTotal == 21) {

                //user instant blackjack
            if ($turncount == 2) {
                return "WIN_BLACKJACK";
            }
            return "WIN";
        }

            if ($cpuTotal == 21)  //cpu instant blackjack
                return "LOSE";

            if ($cpuTotal > 21 && $userTotal <= 21) { //cpu bust
                return "WIN";
            }
        }

        return "ONGOING";

    }
}
