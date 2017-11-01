<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use File;
use Image;

class ProfileController extends Controller
{
    /**
     * View the user's profile
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile', array("user" => Auth::user()));
    }

    public function edit()
    {
        return view('editprofile', array("user" => Auth::user()));
    }

    public function updateAvatar(Request $request)
    {

        //upload avatar
        if ($request->hasFile('avatar')) {
            $user = Auth::user();
            $avatar = $request->file('avatar');
            $filename = $user->name . time() . '.' . $avatar->getClientOriginalExtension();

            if ($user->avatar != "default.jpg")
                File::Delete(public_path("/userimg/") . $user->avatar);

            Image::make($avatar)->resize(200, 200)->save(public_path('/userimg/' . $filename));

            $user->avatar = $filename;
            $user->save();
        }

        return redirect('editprofile/')->with('success', 'Updated avatar.');
    }

    public function updateDesc(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'desc' => 'Required|max:400'
        ]);

        $user->desc = $request['desc'];
        $user->save();
        return redirect('editprofile')->with('success', 'Updated description.');
    }
}
