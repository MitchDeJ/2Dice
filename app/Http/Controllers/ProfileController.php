<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use File;
use Image;
use App\Object;
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
        $objects = Object::where('owner', $user->id)->get();
        $list = "";
        foreach($objects as $obj) {
            $list .= ObjectController::getTypeName($obj->type).' '.LocationController::getName($obj->location).', ';
        }
        $list = substr($list, 0, strlen($list)-2);
        return view('profile', array(
            "user" => $user,
            "lbrank" => $this->getLeaderboardRank(Auth::user()->name),
            "location" => Location::where("id", $user->location)->get()->first(),
            'list' => $list
            ));
    }

    public function otherProfile($name)
    {
        $user = User::where("name", $name)->get()->first();
        $objects = Object::where('owner', $user->id)->get();
        $list = "";
        foreach($objects as $obj) {
            $list .= ObjectController::getTypeName($obj->type).' '.LocationController::getName($obj->location).', ';
        }
        $list = substr($list, 0, strlen($list)-2);
        return view("profile", array(
            "user" => $user,
            "lbrank" => $this->getLeaderboardRank($user->name),
            "location" => Location::where("id", $user->location)->get()->first(),
            'list' => $list
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

            if ($user->avatar != "default.png")
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
