<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Object;
use Auth;

class ObjectController extends Controller
{
    public function changeMaxBet(Request $request) {
        $user = Auth::user();
        $amount = $request->input('amount');
        $location = $request->input('location');
        $type = $request->input('type');
        $object = Object::where('type', $type)->where('location', $location)->get()->first();

        if ($type == 0) {
            $page = 'roulette';
        } else if ($type == 1) {
            $page = 'blackjack';
        } else if ($type == 2) {
            $page = 'location';
        } else if ($type == 3) {
            $page = '55x2';
        } else {
            $page = 'dashboard';
        }

        if ($user->id != $object->owner)
            return redirect($page)->with('fail', 'Only the owner of this object can change the maximum bet.');

        $object->maxbet = $amount;
        $object->save();
        return redirect($page)->with('success', 'Maximum bet has been set to $'.number_format($amount));

    }

    public function bankObject(Request $request) {
        $user = Auth::user();
        $amount = $request->input('amount');
        $location = $request->input('location');
        $type = $request->input('type');
        $object = Object::where('type', $type)->where('location', $location)->get()->first();
        $action = $request->input('action');

        if ($type == 0) {
            $page = 'roulette';
        } else if ($type == 1) {
            $page = 'blackjack';
        } else if ($type == 2) {
            $page = 'location';
        } else if ($type == 3) {
            $page = '55x2';
        } else {
            $page = 'dashboard';
        }

        if ($user->id != $object->owner)
            return redirect($page)->with('fail', 'Only the owner of this object can do that.');

        if ($action == "WITHDRAW") {

            if ($amount < 1)
                return redirect($page)->with('fail', 'Invalid amount.');

            if ($object->cash < $amount)
                return redirect($page)->with('fail', 'There is not that much cash in your objects bank.');

            $user->cash += $amount;
            $object->cash -= $amount;

            $user->save();
            $object->save();
            return redirect($page)->with('success', 'Successfully withdrawn $' . number_format($amount) . '.');
        } else if ($action == "DEPOSIT") {

            if ($amount < 1)
                return redirect($page)->with('fail', 'Invalid amount.');

            if ($user->cash < $amount)
                return redirect($page)->with('fail', 'You do not have that much cash.');

            $user->cash -= $amount;
            $object->cash += $amount;

            $user->save();
            $object->save();
            return redirect($page)->with('success', 'Successfully deposited $' . number_format($amount) . '.');
        } else if ($action == "DEPOSITALL") {
            if ($user->cash < 1)
                return redirect($page)->with('fail', 'You do not have any cash to deposit.');
            $amount = $user->cash;
            $user->cash -= $amount;
            $object->cash += $amount;

            $user->save();
            $object->save();
            return redirect($page)->with('success', 'Successfully deposited $' . number_format($amount) . '.');
        } else if ($action == "WITHDRAWALL") {
            if ($object->cash < 1)
                return redirect($page)->with('fail', 'There is no cash to withdraw.');
            $amount = $object->cash;
            $object->cash -= $amount;
            $user->cash += $amount;

            $user->save();
            $object->save();
            return redirect($page)->with('success', 'Successfully withdrawn $' . number_format($amount) . '.');
        }
    }

    public static function getTypeName($type) {
        switch ($type) {
            case 0:
                return "Roulette";
            case 1:
                return "Blackjack";
            case 2:
                return "Airport";
            case 3:
                return "55x2";
        }
    }
}
