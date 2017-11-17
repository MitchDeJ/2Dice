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
            "lbrank" => ProfileController::getLeaderboardRank(Auth::user()->name),
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
            "lbrank" => ProfileController::getLeaderboardRank($user->name),
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

    public static function getLeaderboardRank($name) {
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
            "unlockedtitles" => unserialize(Auth::user()->unlockedtitles),
            "titlecount" => 18
        ));
    }

    public function unlockTitle(Request $request)
    {
        $user = Auth::user();

        $titleid = $request['i'];

        $unlockedtitles = unserialize($user->unlockedtitles);

        switch ($titleid) {
            case 0:// completionist
                for ($i=1;$i<=15;$i++) {
                if ($unlockedtitles[$i] != 1) {
                    return redirect('titleselection')->with('fail', 'You do not meet the requirements to unlock this title.');
                }
                }
                break;
            case 1:// cleaned
                if ($user->cash > 0) {
                    return redirect('titleselection')->with('fail', 'You do not meet the requirements to unlock this title.');
                }
                break;
            case 2://TODO verander naar koppeltabel als companies added zijn
                if ($user->company == -1) {
                    return redirect('titleselection')->with('fail', 'You do not meet the requirements to unlock this title.');
                }
                break;
            case 3:// traveller
                    return redirect('titleselection')->with('neutral', 'This title will be automatically unlocked.');
                break;
            case 4: //wealthy
                if ($user->cash >= 5000000) {
                    $user->cash-= 5000000;
                } else {
                    return redirect('titleselection')->with('fail', 'You do not have enough cash to unlock this title.');
                }
                break;
            case 5:// gambler
                if ($user->totalbets < 100) {
                    return redirect('titleselection')->with('fail', 'You do not meet the requirements to unlock this title.');
                }
                break;
            case 6:// addict
                if ($user->totalbets < 1000) {
                    return redirect('titleselection')->with('fail', 'You do not meet the requirements to unlock this title.');
                }
                break;
            case 7:// The insane
                if ($user->totalbets < 2500) {
                    return redirect('titleselection')->with('fail', 'You do not meet the requirements to unlock this title.');
                }
                break;
            case 8:// Risky
                if ($user->highestbet < 1000000) {
                    return redirect('titleselection')->with('fail', 'You do not meet the requirements to unlock this title.');
                }
                break;
            case 9:// High roller
                if ($user->highestbet < 10000000) {
                    return redirect('titleselection')->with('fail', 'You do not meet the requirements to unlock this title.');
                }
                break;
            case 10:// Prestiged
                if ($user->prestige < 5) {
                    return redirect('titleselection')->with('fail', 'You do not meet the requirements to unlock this title.');
                }
                break;
            case 11:// Exchanger
                    return redirect('titleselection')->with('neutral', 'This title will be automatically unlocked.');
                break;
            case 12:// Powerful
                if ($user->power < 500000) {
                    return redirect('titleselection')->with('fail', 'You do not meet the requirements to unlock this title.');
                }
                break;
            case 13:// investor
                    return redirect('titleselection')->with('neutral', 'STOCKMARKET NOT HERE YET.');
                break;
            case 14:// Lucky
                return redirect('titleselection')->with('neutral', 'This title will be automatically unlocked.');
                break;
            case 15:// VIP
                if ($user->vip == false) {
                    return redirect('titleselection')->with('fail', 'You do not meet the requirements to unlock this title.');
                }
                break;
            case 16:// #1
                if (ProfileController::getLeaderboardRank($user->name) != 1) {
                    return redirect('titleselection')->with('fail', 'You do not meet the requirements to unlock this title.');
                }
                break;
            case 17:// #1
                    return redirect('titleselection')->with('neutral', 'This title will be automatically unlocked.');
                break;


        }

        $unlockedtitles[$titleid] = 1;
        $user->unlockedtitles = serialize($unlockedtitles);
        $user->save();

        return redirect('titleselection')->with('success', 'Unlocked title: '.Titles::getTitle($titleid));
    }

    public static function forceUnlockTitle($titleid) {
        $user = Auth::user();
        $unlockedtitles = unserialize($user->unlockedtitles);
        $unlockedtitles[$titleid] = 1;
        $user->unlockedtitles = serialize($unlockedtitles);
        $user->save();
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
