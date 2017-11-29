<?php

namespace App\Http\Controllers;

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
                var_dump($ban);
            }
        }
        return redirect('adminpanel')->with('success', $name . ' unbanned.');
    }
}
