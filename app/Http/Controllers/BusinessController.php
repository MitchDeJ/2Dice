<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

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
        return view('collab', array("user" => Auth::user()));
    }

    public function sendCash(Request $request) {
        $amount = $request->input('amount');
        $name = $request->input('name');
        $sender = Auth::user();

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
