<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use File;
use Image;
use App\User;
use App\Location;

class ProfileController extends Controller
{
    /**
     * View the user's profile
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('profile', array(
            "user" => $user,
            "lbrank" => $this->getLeaderboardRank(Auth::user()->name),
            "location" => Location::where("id", $user->location)->get()->first()
            ));
    }

    public function otherProfile($name)
    {
        $user = User::where("name", $name)->get()->first();
        return view("profile", array(
            "user" => $user,
            "lbrank" => $this->getLeaderboardRank($user->name),
            "location" => Location::where("id", $user->location)->get()->first()
            ));
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

    public function getLeaderboardRank($name) {
        $i = 0;
        foreach(User::all()->sortByDesc('power') as $p) {
            $i++;
            if ($p->name == $name) {
                return $i;
            }
        }
    }

    /**
     * Show the application title selection.
     *
     * @return \Illuminate\Http\Response
     */
    public function titleIndex()
    {
        return view('titleselection');
    }

}
