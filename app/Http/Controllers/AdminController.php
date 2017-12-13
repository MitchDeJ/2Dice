<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Ban;

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::user()->name == "admin")
            return view('adminpanel', array("user" => Auth::user()));
        else
            return view('404');
    }

    public function addVip(Request $request) {
        $days = $request->input('days');
        $name = $request->input('name');

        $UNIXDAY = 86400;

        $found = User::where('name', $name)->get();

        if ($found->count() == 0) {
            return redirect('adminpanel')->with('fail', 'User "'.$name.'" not found.');
        }
            SubscriptionController::addSubscription($name, $days * $UNIXDAY);
            return redirect('adminpanel')->with('success', $days.' days of VIP added to user "'.$name.'"');
    }

    public function ban(Request $request)
    {
        $name = $request->input('name');
        $reason = $request->input('reason');
        $found = User::where('name', $name)->get();
        if ($found->count() == 0) {
            return redirect('adminpanel')->with('fail', 'User "' . $name . '" not found.');
        }
        $user = $found->first();

        Ban::create([
            'user' => $user->id,
            'reason' => $reason
        ]);

        $user->desc = "This player is banned. Reason: ".$reason;
        $user->save();

        return redirect('adminpanel')->with('success', $name . ' banned for reason: ' . $reason);
    }

    public function unban(Request $request)
    {
        $name = $request->input('name');
        $found = User::where('name', $name)->get();
        if ($found->count() == 0) {
            return redirect('adminpanel')->with('fail', 'User "' . $name . '" not found.');
        }
        $user = $found->first();
        $bans = Ban::where('user', $user->id)->get();
        if ($bans->count() > 0) {
            foreach($bans as $ban) {
                $ban->delete();
            }
        }
        $user->desc = "";
        $user->save();

        return redirect('adminpanel')->with('success', $name . ' unbanned.');
    }

    public function sendAdminMessage(Request $request) {
        $action = $request->input('action');
        $to = $request->input('to');
        $title = $request->input('title');
        $message = $request->input('text');

        if ($action == "ALL") {//message to all players
            $users = User::all();
            foreach($users as $user) {
                if ($user->name != "admin")
                MessageController::sendSystemMessage($user->name,
                    $title,
                    $message
                    );
            }
            return redirect('adminpanel')->with('success', 'All message sent.');
        }
        if ($action == "SOLO") {//message to one player
            $found = User::where('name', $to)->get();
            if ($found->count() == 0) {
                return redirect('adminpanel')->with('fail', 'User "' . $to . '" not found.');
            }
            $user = $found->first();
            MessageController::sendSystemMessage($user->name,
                $title,
                $message
            );
            return redirect('adminpanel')->with('success', 'Message sent.');
        }
    }
}
