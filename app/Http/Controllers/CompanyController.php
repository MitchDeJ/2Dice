<?php

namespace App\Http\Controllers;

use App\JoinRequest;
use Illuminate\Http\Request;
use Auth;
use App\Location;
use App\Company;
use App\Affiliation;
use App\User;
use File;
use Image;

class CompanyController extends Controller
{

    //index functions

    public function companyCreate()
    {
        return view('companycreate', array(
            "user" => Auth::user(),
            "location" => Location::where('id', Auth::user()->location)->get()->first()
        ));
    }

    public function companyProfile()
    {
        $user = Auth::user();

        if (CompanyController::getAffiliation($user) == -1) {
            return $this->companyCreate();
        }

        $company = Company::where('id', CompanyController::getAffiliation($user))->get()->first();
        $mycompany = CompanyController::getAffiliation($user);
        $location = LocationController::getName($company->location);
        $members = CompanyController::getCompanyMembers($company->id);


        $roles = array();
        $ranks = array();
        $totalpower = 0;
        foreach ($members as $member) {
            //getting all member roles to display
            $roles[$member->id] = Affiliation::where('user', $member->id)->get()->first()->rights;
            //getting all player leaderboard ranks to display
            $ranks[$member->id] = ProfileController::getLeaderboardRank($member->name);
            //adding up for total power
            $totalpower += $member->power;
        }


        return view('companyprofile', array(
            "user" => $user,
            "company" => $company,
            "location" => $location,
            "members" => $members,
            'roles' => $roles,
            'ranks' => $ranks,
            'totalpower' => $totalpower,
            'mycompany' => $mycompany,
            'pending' => false
        ));
    }

    public function viewRequests()
    {
        $user = Auth::user();

        if (CompanyController::getAffiliation($user) == -1) {
            return $this->companyCreate();
        }

        $company = Company::where('id', CompanyController::getAffiliation($user))->get()->first();
        //TODO permissions

        $requests = JoinRequest::where('company', $company->id)->get();
        $users = array();
        foreach ($requests as $req) {
            $users[$req->id] = User::where('id', $req->user)->get()->first();
        }

        return view('viewrequests', array(
            'user' => $user,
            'users' => $users,
            'company' => $company,
            'requests' => $requests
        ));
    }


    public function otherProfile($name)
    {
        $user = Auth::user();

        $company = Company::where('name', $name)->get()->first();
        $mycompany = CompanyController::getAffiliation($user);
        $location = LocationController::getName($company->location);
        $members = CompanyController::getCompanyMembers($company->id);

        $pending = false;

        if (JoinRequest::where('user', Auth::user()->id)->get()->count() > 0)
            $pending = true;

        $roles = array();
        $ranks = array();
        $totalpower = 0;
        $i = 0;
        foreach ($members as $member) {
            //getting all member roles to display
            $roles[$member->id] = Affiliation::where('user', $member->id)->get()->first()->rights;
            //getting all player leaderboard ranks to display
            $ranks[$member->id] = ProfileController::getLeaderboardRank($member->name);
            //adding up for total power
            $totalpower += $member->power;
        }


        return view('companyprofile', array(
            "user" => $user,
            "company" => $company,
            "location" => $location,
            "members" => $members,
            'roles' => $roles,
            'ranks' => $ranks,
            'totalpower' => $totalpower,
            'mycompany' => $mycompany,
            'pending' => $pending
        ));
    }

    public function editProfile()
    {
        $user = Auth::user();

        if (CompanyController::getAffiliation($user) == -1) {
            return $this->companyCreate();
        }

        $company = Company::where('id', CompanyController::getAffiliation($user))->get()->first();


        //TODO permission to edit profile

        return view('editcompanyprofile', array(
            "user" => $user,
            "company" => $company,
        ));
    }

    public function updateAvatar(Request $request)
    {

        //upload avatar
        if ($request->hasFile('avatar')) {
            $user = Auth::user();

            if (CompanyController::getAffiliation($user) == -1) {
                return $this->companyCreate();
            }

            $company = Company::where('id', CompanyController::getAffiliation($user))->get()->first();

            //TODO permissions

            $avatar = $request->file('avatar');
            $filename = $company->name . time() . '.' . $avatar->getClientOriginalExtension();

            if ($company->avatar != "default.png")
                File::Delete(public_path("/companyimg/") . $company->avatar);

            Image::make($avatar)->resize(200, 200)->save(public_path('/companyimg/' . $filename));

            $company->avatar = $filename;
            $company->save();
        }

        return redirect('editcompanyprofile')->with('success', 'Updated avatar.');
    }

    public function updateDesc(Request $request)
    {
        $user = Auth::user();

        if (CompanyController::getAffiliation($user) == -1) {
            return $this->companyCreate();
        }

        $company = Company::where('id', CompanyController::getAffiliation($user))->get()->first();

        //TODO permissions

        $this->validate($request, [
            'desc' => 'Required|max:400'
        ]);

        $company->desc = $request['desc'];
        $company->save();
        return redirect('editcompanyprofile')->with('success', 'Updated description.');
    }

    public function companyLeaderboard()
    {
        return view('companyleaderboard', array("user" => Auth::user()));
    }

    public function companyDashboard()
    {
        return view('companydashboard', array("user" => Auth::user()));
    }

    //Creating a company

    public function createCompany(Request $request)
    {
        $user = Auth::user();
        $name = $request->input('name');

        $this->validate($request, [
            'name' => 'required|unique:companies|regex:/(^[A-Za-z0-9 ]+$)+/|min:3|max:15',
        ]);

        $price = 500000;

        if ($user->cash < $price) {
            return redirect('companycreate')->with('fail', 'You dont have enough cash to create a company.');
        }

        if (CompanyController::getAffiliation($user) != -1) {
            return redirect('companycreate')->with('fail', 'You are already part of a company.');
        }

        $user->cash -= $price;
        $user->save();

        $company = Company::create([
            'name' => $name,
            'owner' => $user->name,
            'location' => $user->location,
            'createdat' => date("d-m-y")
        ]);

        Affiliation::create([
            'user' => $user->id,
            'company' => $company->id,
            'rights' => 3
        ]);

        return redirect('companyprofile')->with('success', 'Company "' . $name . '" created!');
    }

    public function sendJoinRequest(Request $request)
    {
        $user = Auth::user();
        $company = Company::where('id', $request->input('id'))->get();

        if ($company->count() == 0) {
            return redirect('companyprofile')->with('fail', 'Invalid company.');
        }

        $company = $company->first();

        if (self::getAffiliation($user) != -1) {
            return redirect('companyprofile/' . $company->name)->with('fail', 'You are already part of a company.');
        }

        JoinRequest::create([
            'user' => $user->id,
            'company' => $company->id
        ]);
        return redirect('companyprofile/' . $company->name)->with('success', 'Request sent.');
    }

    public function acceptJoinRequest(Request $request)
    {
        $req = JoinRequest::where('id', $request->input('id'))->get();

        if ($req->count() == 0) {
            return redirect('viewrequests')->with('fail', 'Invalid request.');
        }

        $req = $req->first();

        $user = Auth::user();
        $company = Company::where('id', $req->company)->get()->first();
        $applicant = User::where('id', $req->user)->get()->first();

        if (self::getAffiliation($user) != $req->company) {
            return redirect('viewrequests')->with('fail', 'You do not have permission to handle that request.');
        }

        if (self::getAffiliation($applicant) != -1) {
            $req->delete();
            return redirect('viewrequests')->with('neutral', $applicant->name . ' has already joined a different company.');
        }

        //TODO Permissions

        //accepting
        $req->delete();
        Affiliation::create([
            'user' => $applicant->id,
            'company' => $company->id,
            'rights' => 0
        ]);

        MessageController::sendSystemMessage($applicant->name,
            'Your request to join ' . $company->name . " has been accepted.",
            'You are now part of this company.'
        );
        return redirect('viewrequests')->with('success', 'Accepted ' . $applicant->name . "'s request.");
    }

    public function declineJoinRequest(Request $request)
    {
        $req = JoinRequest::where('id', $request->input('id'))->get();

        if ($req->count() == 0) {
            return redirect('viewrequests')->with('fail', 'Invalid request.');
        }

        $req = $req->first();

        $user = Auth::user();
        $company = Company::where('id', $req->company)->get()->first();
        $applicant = User::where('id', $req->user)->get()->first();

        if (self::getAffiliation($user) != $req->company) {
            return redirect('viewrequests')->with('fail', 'You do not have permission to handle that request.');
        }

        if (self::getAffiliation($applicant) != -1) {
            $req->delete();
            return redirect('viewrequests')->with('success', 'Declined ' . $applicant->name . "'s request.");
        }

        //TODO Permissions

        //declined
        $req->delete();

        MessageController::sendSystemMessage($applicant->name,
            'Your request to join ' . $company->name . " has been declined.",
            'For more information, contact a representative of the company.'
        );
        return redirect('viewrequests')->with('success', 'Declined ' . $applicant->name . "'s request.");
    }

    public static function getAffiliation(User $user)
    {
        $a = Affiliation::where('user', $user->id)->get();
        if ($a->count() == 0) {
            return -1;
        } else {
            return $a->first()->company;
        }
    }

    public static function getCompanyName($id)
    {
        return Company::where('id', $id)->get()->first()->name;
    }

    public static function getCompanyMembers($id)
    {
        $members = Affiliation::where('company', $id)->get()->sortByDesc('rights');
        $users = array();
        $i = 0;
        foreach ($members as $member) {
            $user = User::where('id', $member->user)->get()->first();
            $users[$i] = $user;
            $i++;
        }
        return $users;
    }
}
