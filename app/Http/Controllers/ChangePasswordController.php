<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;

class ChangePasswordController extends Controller
{
    /**
     * Change the user password
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('changepassword', array("user" => Auth::user()));
    }

    public function changePassword(Request $request) {
        $old = $request->input('old');
        $new = $request->input('new');
        $newconfirm = $request->input('newconfirm');

        $user = Auth::user();

        if (!Hash::check($old, $user->password)) {
            return redirect('changepassword')->with('fail', 'Incorrect password.');
        }

        if (!($new == $newconfirm)) {
            return redirect('changepassword')->with('fail', 'New passwords do not match.');
        }

        $user->password = bcrypt($new);
        $user->save();
        return redirect('changepassword')->with('success', 'Password changed.');
    }

}
