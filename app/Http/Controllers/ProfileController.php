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
        return view('titleselection', array(
            "user" => Auth::user(),
            "titlecount" => 1
        ));
    }

    public function unlockTitle(Request $request)
    {
        $user = Auth::user();

        $titleid = $request['i'];

        $unlockedtitles = unserialize($user->unlockedtitles);

        switch ($titleid) {
            //
        }

        $unlockedtitles[$titleid] = 1;
        $user->unlockedtitles = serialize($unlockedtitles);
        $user->save();

        return redirect('titleselection')->with('success', 'Succesfully unlocked title.');
    }

    public function setTitle(Request $request)
    {
        $user = Auth::user();
        $title = $request['i'];
        $unlockedtitles = unserialize($user->unlockedtitles);

        if ($unlockedtitles[$title] == 0)
            return redirect('titleselection')->with('fail', 'You have not unlocked this title yet.');

        $user->title = $title;
        $user->save();
        return redirect('titleselection')->with('success', 'Set title to: '.Titles::getTitle($title));
    }

    public function clearTitle(Request $request)
    {
        $user = Auth::user();
        $user->title = -1;
        $user->save();
        return redirect('titleselection')->with('success', 'Cleared title.');
    }

}
