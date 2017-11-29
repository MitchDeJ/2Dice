<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Cooldown;
use App\Collab;

class BusinessController extends Controller
{
    /**
     * Show the application send cash view.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendCashIndex()
    {
        return view('sendcash', array("user" => Auth::user()));
    }

    /**
     * Show the application collaboration view.
     *
     * @return \Illuminate\Http\Response
     */
    public function collabIndex()
    {
        return view('collab', array(
            "user" => Auth::user(),
            "collabs" => Collab::all()
        ));
    }

    public function newCollab(Request $request) {
        $user = Auth::user();
        $found = Collab::where('user', $user->name)->get()->count();

        if ($found > 0) {
            return redirect('collab')->with('fail', 'You already have a collab group.');
        }

        if ($user::onCooldown($user, 73)) {
            $cd = Cooldown::where('user', $user->id)->where('type', 73)->get()->first();
            $minutes = round(($cd->end - time())/60);
            return redirect('collab')->with('fail', 'You have to wait another '.$minutes.' minutes to start a collab.');
        }

        Collab::create([
            'user' => $user->name
        ]);

        return redirect('collab')->with('success', 'Collab group created. ');
    }

    public function cancelCollab(Request $request) {
        $id = $request->input('id');

        if (Collab::where('id', $id)->get()->count() == 0) {
            return redirect('collab')->with('fail', 'Invalid collab.');
        }

        $c = Collab::where('id', $id)->get()->first();

        if (Auth::user()->name != $c->user) {
            return redirect('collab')->with('fail', 'Only the starter of the collab group can do that.');
        }

        $c->delete();
        return redirect('collab')->with('success', 'Collab cancelled. ');
    }

    public function joinCollab(Request $request) {
        $id = $request->input('id');

        if (Collab::where('id', $id)->get()->count() == 0) {
            return redirect('collab')->with('fail', 'Invalid collab.');
        }

        $c = Collab::where('id', $id)->get()->first();

        $user = Auth::user();

        if ($user::onCooldown($user, 73)) {
            $cd = Cooldown::where('user', $user->id)->where('type', 73)->get()->first();
            $minutes = round(($cd->end - time())/60);
            return redirect('collab')->with('fail', 'You have to wait another '.$minutes.' minutes to join a collab.');
        }
        $reward = 200000;//200k
        $rand = rand(1,100);

        if ($rand <= 10) {
            $reward *=2;
        }
        if ($rand >= 90) {
            $reward /=2;
        }

        $starter = User::where('name', $c->user)->get()->first();

        $user->cash += $reward;
        $starter->cash += $reward;
        $user->save();
        $starter->save();

        MessageController::sendSystemMessage($starter->name,
            "Collaboration results",
            "You did a business collaboration with ".$user->name.". It resulted in a profit of $".number_format($reward)." each."
        );

        $user::addCooldown($user, 73, (60 * 60) * 4);
        $starter::addCooldown($starter, 73, (60 * 60) * 4);
        RankController::addXp($user, 15000);
        RankController::addXp($starter, 15000);
        $c->delete();

        return redirect("collab")->with('success', "Your collab with ".$starter->name." resulted in a profit of $".number_format($reward)." each.");
    }


    public function sendCash(Request $request) {
        $amount = $request->input('amount');
        $name = $request->input('name');
        $sender = Auth::user();

        if ($sender::isStarter($sender->id)) {
            return redirect('sendcash')->with('fail', "You can not send cash for the first 24 hours after account creation.");
        }

        if ($sender->cash < $amount)
            return redirect('sendcash')->with('fail', "You don't have that much cash.");

        if ($amount < 1)
            return redirect('sendcash')->with('fail', "Why would you send nothing?");


        $found = User::where('name', $name)->get()->count();

        if ($found != 0) {
            $user = User::where('name', $name)->get()->first();
            if ($user->name == $sender->name)
                return redirect('sendcash')->with('fail', 'Why would you send cash to yourself?');

            $user->cash += $amount;
            $sender->cash -= $amount;

            $user->save();
            $sender->save();
            MessageController::sendSystemMessage($name, $sender->name." has sent you $".number_format($amount).".","");
            return redirect('sendcash')->with('success', 'Sent $'.number_format($amount).' to '.$name.'.');
        } else {
            return redirect('sendcash')->with('fail', 'User "'.$name.'" not found.');
        }
    }
}
