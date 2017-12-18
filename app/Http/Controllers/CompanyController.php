<?php

namespace App\Http\Controllers;

use App\JoinRequest;
use Illuminate\Http\Request;
use Auth;
use App\Location;
use App\Company;
use App\Affiliation;
use App\User;
use App\Factory;
use App\CompanyOptions;
use File;
use Image;

class CompanyController extends Controller
{

    //index functions

    public function companyCreate()
    {
        $factories = array();
        $types = 3; //only the first basic 3 factories are free

        for ($i = 0; $i < $types; $i++) {
            $factories[$i] = FactoryController::getTypeName($i);
        }

        return view('companycreate', array(
            "user" => Auth::user(),
            "location" => Location::where('id', Auth::user()->location)->get()->first(),
            "factories" => $factories
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
        $rank =  self::getLeaderboardRank($company->id);


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
            'pending' => false,
            'rank' => $rank
        ));
    }

    public function viewRequests()
    {
        $user = Auth::user();

        if (CompanyController::getAffiliation($user) == -1) {
            return $this->companyCreate();
        }

        $company = Company::where('id', CompanyController::getAffiliation($user))->get()->first();

        if (!self::hasRights($user, self::getOptions($company->id)->handlerequests)) {
            return redirect('companydashboard')->with('fail', 'You do not have permission to handle join requests.');
        }

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
        $rank =  self::getLeaderboardRank($company->id);

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
            'pending' => $pending,
            'rank' => $rank
        ));
    }

    public function editProfile()
    {
        $user = Auth::user();

        if (CompanyController::getAffiliation($user) == -1) {
            return $this->companyCreate();
        }

        $company = Company::where('id', CompanyController::getAffiliation($user))->get()->first();


        if (!self::hasRights($user, self::getOptions($company->id)->editprofile)) {
            return redirect('companyprofile')->with('fail', 'You do not have permission to edit the company profile.');
        }

        return view('editcompanyprofile', array(
            "user" => $user,
            "company" => $company,
        ));
    }

    public function manageMembers()
    {
        $user = Auth::user();

        if (CompanyController::getAffiliation($user) == -1) {
            return $this->companyCreate();
        }

        $company = Company::where('id', CompanyController::getAffiliation($user))->get()->first();
        $members = self::getCompanyMembers($company->id);
        $i = 0;
        foreach ($members as $member) {
            if ($member->id == $user->id)
                unset($members[$i]);
            if ($member->name == $company->owner)
                unset($members[$i]);
            $i++;
        }

        if (!self::hasRights($user, self::getOptions($company->id)->handlerequests) && !self::hasRights($user, self::getOptions($company->id)->setroles)) {
            return redirect('companydashboard')->with('fail', 'You do not have permission to access member management.');
        }

        return view('managemembers', array(
            "user" => $user,
            "company" => $company,
            'members' => $members
        ));
    }

    public function companyOptions()
    {
        $user = Auth::user();

        if (CompanyController::getAffiliation($user) == -1) {
            return $this->companyCreate();
        }

        $company = Company::where('id', CompanyController::getAffiliation($user))->get()->first();
        $membercount = count(self::getCompanyMembers($company->id));

        if (self::getRights($user) == 3)
            $enabled = "";
        else
            $enabled = "disabled";

        return view('companyoptions', array(
            "user" => $user,
            "company" => $company,
            "enabled" => $enabled,
            'membercount' => $membercount
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

            if (!self::hasRights($user, self::getOptions($company->id)->editprofile)) {
                return redirect('companyprofile')->with('fail', 'You do not have permission to edit the company profile.');
            }

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

        if (!self::hasRights($user, self::getOptions($company->id)->editprofile)) {
            return redirect('companyprofile')->with('fail', 'You do not have permission to edit the company profile.');
        }

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
        $user = Auth::user();
        if (CompanyController::getAffiliation($user) == -1) {
            return $this->companyCreate();
        }

        $company = Company::where('id', CompanyController::getAffiliation($user))->get()->first();
        $quicksells = array();
        $items = MarketplaceController::getItemNames();
        for ($i = 0; $i < count($items); $i++) {
            $quicksells[$i] = LocationController::getSellPrice($company->location, $i);
        }

        $items = $items->except(3);
        $limit = self::getStorageLimit($company);

        return view('companydashboard', array(
            "user" => Auth::user(),
            'company' => $company,
            'quicksells' => $quicksells,
            'items' => $items,
            'limit' => $limit
        ));
    }

    //Creating a company

    public function createCompany(Request $request)
    {
        $user = Auth::user();
        $name = $request->input('name');
        $type = $request->input('type');

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

        if (!FactoryController::validType($type)) {
            return redirect('companycreate')->with('fail', 'Invalid factory.');
        }

        if (!FactoryController::isGatherType($type)) {
            return redirect('companycreate')->with('fail', 'Only gathering factories can be built at this point.');
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

        Factory::create([
            'company' => $company->id,
            'type' => $type
        ]);

        //making an options instance
        CompanyOptions::create(['company' => $company->id]);

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

        $options = self::getOptions($company->id);

        foreach (self::getCompanyMembers($company->id) as $member) {
            if (self::hasRights($member, $options->handlerequests))
                MessageController::sendSystemMessage(
                    $member->name,
                    $user->name . " has requested to join " . self::getCompanyName($company->id) . '.',
                    'To handle this request, check out the join requests page.'
                );
        }

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

        if (!self::hasRights($user, self::getOptions($company->id)->handlerequests)) {
            return redirect('companydashboard')->with('fail', 'You do not have permission to handle join requests.');
        }

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

        if (!self::hasRights($user, self::getOptions($company->id)->handlerequests)) {
            return redirect('companydashboard')->with('fail', 'You do not have permission to handle join requests.');
        }

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

    public static function getRights(User $user)
    {
        if (self::getAffiliation($user) == -1)
            return -1;

        $a = Affiliation::where('company', self::getAffiliation($user))->where('user', $user->id)->get()->first();
        return $a->rights;
    }

    public static function hasRights(User $user, $rights)
    {
        if (self::getRights($user) >= $rights) {
            return true;
        }
        return false;
    }

    public static function getOptions($id)
    {
        return CompanyOptions::where('company', $id)->get()->first();
    }

    public function setRole(Request $request)
    {
        $rights = $request->input('rights');
        $uid = $request->input('id');

        $user = Auth::user();
        $cid = self::getAffiliation($user);
        $user2 = User::where('id', $uid)->get();

        //this role doesnt exist
        if (ComAff::getRole($rights) == "")
            return redirect("managemembers")->with('fail', 'Invalid role.');

        if ($user2->count() == 0) //if the user doesnt exist
            return redirect("managemembers")->with('fail', 'Invalid user.');

        $user2 = $user2->first();

        if (self::getAffiliation($user2) != $cid) //if the user isnt in your company
            return redirect("managemembers")->with('fail', 'Invalid user.');

        $options = self::getOptions($cid);

        //check if the user has permission to set roles
        if (!self::hasRights($user, $options->setroles))
            return redirect("managemembers")->with('fail', 'You do not have permission to do that.');

        if ($rights > self::getRights($user))
            return redirect("managemembers")->with('fail', 'You can not give someone a role that is higher than your own.');

        if (self::getRights($user2) >= self::getRights($user))
            return redirect("managemembers")->with('fail', 'You do not have permission to do that.');

        $aff = Affiliation::where('company', $cid)->where('user', $user2->id)->get()->first();

        if ($aff->rights == $rights)
            return redirect('managemembers')->with('fail', $user2->name . " already has that role.");

        $word = "";

        if ($rights > $aff->rights)
            $word = "promoted";

        if ($rights < $aff->rights)
            $word = "demoted";

        $aff->rights = $rights;
        $aff->save();

        MessageController::sendSystemMessage(
            $user2->name,
            "You have been " . $word . " within " . self::getCompanyName($cid) . '.',
            "Your role has been changed to " . ComAff::getRole($rights) . "."
        );
        return redirect("managemembers")->with('success', $user2->name . "'s role has been set to: " . ComAff::getRole($rights));
    }

    public function kick(Request $request)
    {
        $uid = $request->input('id');
        $user = Auth::user();
        $cid = self::getAffiliation($user);
        $user2 = User::where('id', $uid)->get();

        if ($user2->count() == 0) //if the user doesnt exist
            return redirect("managemembers")->with('fail', 'Invalid user.');

        $user2 = $user2->first();

        if (self::getAffiliation($user2) != $cid) //if the user isnt in your company
            return redirect("managemembers")->with('fail', 'Invalid user.');

        $options = self::getOptions($cid);

        //check if the user has permission to kick
        if (!self::hasRights($user, $options->handlerequests))
            return redirect("managemembers")->with('fail', 'You do not have permission to do that.');

        if (self::getRights($user2) >= self::getRights($user))
            return redirect("managemembers")->with('fail', 'You do not have permission to do that.');

        $aff = Affiliation::where('company', $cid)->where('user', $user2->id)->get()->first();
        $aff->delete();
        MessageController::sendSystemMessage(
            $user2->name,
            "You have been kicked from " . self::getCompanyName($cid) . '.',
            'For more information, contact a representative of the company.'
        );
        return redirect("managemembers")->with('success', 'Kicked ' . $user2->name . ".");
    }

    public function leave(Request $request)
    {
        $user = Auth::user();

        if (self::getAffiliation($user) == -1)
            return redirect("dashboard")->with('fail', 'You are not part of a company.');

        $cid = self::getAffiliation($user);
        $company = Company::where('id', $cid)->get()->first();

        if ($user->name == $company->owner)
            return redirect("dashboard")->with('fail', 'The owner of the company can not leave.');

        $aff = Affiliation::where('company', $cid)->where('user', $user->id)->get()->first();
        $aff->delete();

        $options = self::getOptions($cid);

        foreach (self::getCompanyMembers($cid) as $member) {
            if (self::hasRights($member, $options->handlerequests))
                MessageController::sendSystemMessage(
                    $member->name,
                    $user->name . " has left " . self::getCompanyName($cid) . '.',
                    'For more information, please contact ' . $user->name . '.'
                );
        }
        return redirect('dashboard')->with('success', 'You have left ' . self::getCompanyName($cid) . '.');
    }

    public function disband(Request $request)
    {
        $user = Auth::user();

        if ($request->input('confirm') != 1)
            return redirect("companydashboard")->with('fail', 'Please confirm that you want to disband your company.');

        if (self::getAffiliation($user) == -1)
            return redirect("dashboard")->with('fail', 'You are not part of a company.');

        $cid = self::getAffiliation($user);
        $company = Company::where('id', $cid)->get()->first();

        if ($user->name != $company->owner)
            return redirect("companydashboard")->with('fail', 'Only the owner of the company can disband.');

        //disbanding

        $name = self::getCompanyName($cid);
        foreach (self::getCompanyMembers($cid) as $member) {
            MessageController::sendSystemMessage(
                $member->name,
                $name . ' has been disbanded.',
                'You are now free to join or create a company.'
            );
        }

        $affs = Affiliation::where('company', $cid)->get();
        foreach ($affs as $a) {
            $a->delete();
        }

        $company->delete();
        return redirect('dashboard')->with('success', $name . ' disbanded.');
    }

    public function changeOwner(Request $request)
    {
        $name = $request->input('name');
        $user = Auth::user();
        $user2 = User::where('name', $name)->get();

        if ($user2->count() == 0)
            return redirect('managemembers')->with('fail', 'Invalid user "' . $name . '".');

        $user2 = $user2->first();

        if (self::getAffiliation($user) != self::getAffiliation($user2))
            return redirect('managemembers')->with('fail', $user2->name . ' is not part of your company.');

        $company = Company::where('id', self::getAffiliation($user))->get()->first();

        if ($company->owner != $user->name)
            return redirect("managemembers")->with('fail', 'Only the owner of the company can do that.');

        if ($user->name == $user2->name)
            return redirect("managemembers")->with('fail', 'Why would you do that?');

        $usera = Affiliation::where('user', $user->id)->get()->first();
        $user2a = Affiliation::where('user', $user2->id)->get()->first();

        $usera->rights = 0;
        $user2a->rights = 3;
        $usera->save();
        $user2a->save();

        $company->owner = $user2->name;
        $company->save();

        MessageController::sendSystemMessage(
            $user2->name,
            'You are now the owner of ' . $company->name . '.',
            $user->name . ' has transferred ownership of ' . $company->name . ' to you.'
        );

        return redirect('companydashboard')->with('success', $user2->name . ' is now the owner of ' . $company->name . '.');
    }

    public function setOption(Request $request)
    {
        $option = $request->input('option');
        $value = $request->input('value');
        $user = Auth::user();

        if (ComAff::getRole($value) == "")
            return redirect("companyoptions")->with('fail', 'Invalid value.');

        if (self::getAffiliation($user) == -1)
            return redirect("dashboard")->with('fail', 'You are not part of a company.');

        if (self::getRights($user) != 3)
            return redirect('companyoptions')->with('fail', 'Only the owner can change options.');

        $company = Company::where('id', self::getAffiliation($user))->get()->first();
        $options = self::getOptions($company->id);

        $valueN = "";

        switch ($value) {
            case 0:
                $valueN = "Everyone";
                break;
            case 1:
                $valueN = "Moderator +";
                break;
            case 2:
                $valueN = "Admin +";
                break;
            case 3:
                $valueN = "Owner";
                break;
        }


        switch ($option) {
            case "editprofile":
                $options->editprofile = $value;
                $options->save();
                return redirect('companyoptions')->with('success', "Option 'Edit profile' set to: " . $valueN);
            case "makeoffers":
                $options->makeoffers = $value;
                $options->save();
                return redirect('companyoptions')->with('success', "Option 'Make / use market offers' set to: " . $valueN);
            case "viewoffers":
                $options->viewoffers = $value;
                $options->save();
                return redirect('companyoptions')->with('success', "Option 'View market offers' set to: " . $valueN);
            case "handlerequests":
                $options->handlerequests = $value;
                $options->save();
                return redirect('companyoptions')->with('success', "Option 'Handle requests / kick members' set to: " . $valueN);
            case "setroles":
                $options->setroles = $value;
                $options->save();
                return redirect('companyoptions')->with('success', "Option 'Set roles' set to: " . $valueN);
            case "quicksell":
                $options->quicksell = $value;
                $options->save();
                return redirect('companyoptions')->with('success', "Option 'Quick-sell resources' set to: " . $valueN);
            case "expand":
                $options->expand = $value;
                $options->save();
                return redirect('companyoptions')->with('success', "Option 'Build / expand' set to: " . $valueN);
            default:
                return redirect('companyoptions')->with('fail', "Invalid option.");
        }
    }

    public function setSalary(Request $request)
    {
        $amount = $request->input('amount');
        $user = Auth::user();

        if ($amount < 1)
            return redirect("companyoptions")->with('fail', 'Invalid amount');

        if ($amount > config('app.maxcash'))
            return redirect("companyoptions")->with('fail', 'Invalid amount');

        if (self::getAffiliation($user) == -1)
            return redirect("dashboard")->with('fail', 'You are not part of a company.');

        if (self::getRights($user) != 3)
            return redirect('companyoptions')->with('fail', 'Only the owner can change options.');

        $company = Company::where('id', self::getAffiliation($user))->get()->first();
        $options = self::getOptions($company->id);

        $options->salary = $amount;
        $options->save();
        return redirect('companyoptions')->with('success', 'Salary set to: $' . number_format($amount) . '.');
    }

    public function depositCash(Request $request)
    {
        $user = Auth::user();
        $amount = $request->input('amount');

        if (self::getAffiliation($user) == -1)
            return redirect("dashboard")->with('fail', 'You are not part of a company.');

        $cid = self::getAffiliation($user);
        $company = Company::where('id', $cid)->get()->first();

        if ($amount < 1)
            return redirect('companydashboard')->with('fail', 'Invalid amount.');

        if ($amount > $user->cash)
            return redirect('companydashboard')->with('fail', 'You do not have that much cash.');

        $company->cash += $amount;
        $user->cash -= $amount;

        $user->save();
        $company->save();
        return redirect('companydashboard')->with('success', 'Deposited $' . number_format($amount) . '.');
    }

    public function depositItem(Request $request)
    {
        $user = Auth::user();
        $amount = $request->input('amount');
        $item = $request->input('item');

        if (self::getAffiliation($user) == -1)
            return redirect("dashboard")->with('fail', 'You are not part of a company.');

        $cid = self::getAffiliation($user);
        $company = Company::where('id', $cid)->get()->first();

        if (!MarketplaceController::validItem($item))
            return redirect('companydashboard')->with('fail', 'Invalid item.');

        if ($amount < 1)
            return redirect('companydashboard')->with('fail', 'Invalid amount.');

        if (!MarketplaceController::hasItem($user, $item, $amount))
            return redirect('companydashboard')->with('fail', 'You do not have enough ' . strtolower(MarketplaceController::getItemnames()[$item]) . '.');

        $now = MarketplaceController::getItem($company, $item);
        $limit = self::getStorageLimit($company);

        if ($now == $limit) {
            return redirect('companydashboard')->with('fail', "The company's " . strtolower(MarketplaceController::getItemnames()[$item]) . " storage is full.");
        }

        if (($now + $amount) > $limit) {
            $amount = $limit - $now;
        }

        MarketplaceController::addItem($company, $item, $amount);
        MarketplaceController::removeItem($user, $item, $amount);

        $user->save();
        $company->save();
        return redirect('companydashboard')->with('success', 'Deposited ' . number_format($amount) . ' ' . strtolower(MarketplaceController::getItemnames()[$item]) . '.');
    }

    public function quickSell(Request $request)
    {
        $user = Auth::user();
        $item = $request->input('item');

        if (self::getAffiliation($user) == -1)
            return redirect('dashboard')->with('fail', 'You are not part of a company.');

        $company = Company::where('id', self::getAffiliation($user))->get()->first();

        if (!MarketplaceController::validItem($item))
            return redirect('companydashboard')->with('fail', 'Invalid item.');

        $price = LocationController::getSellPrice($company->location, $item);
        $amount = $request->input('amount');

        if ($amount < 1)
            return redirect('companydashboard')->with('fail', 'Invalid amount.');

        if ($amount > config('app.maxcash') || $amount * $price > config('app.maxcash'))
            return redirect('companydashboard')->with('fail', 'Invalid amount.');

        $options = self::getOptions(self::getAffiliation($user));
        if (!self::hasRights($user, $options->quicksell))
            return redirect('companydashboard')->with('fail', 'You do not have permission to do that.');

        if (!MarketplaceController::hasItem($company, $item, $amount))
            return redirect('companydashboard')->with('fail', 'The company does not have enough ' . strtolower(MarketplaceController::getItemnames()[$item]) . '.');

        //acutally selling
        MarketplaceController::removeItem($company, $item, $amount);
        $company->cash += $amount * $price;
        $company->save();

        return redirect('companydashboard')->with('success',
            'Sold ' . number_format($amount) . " " . strtolower(MarketplaceController::getItemnames()[$item]) . " for $" . number_format($price * $amount) . '.');
    }

    public static function getStorageLimit(Company $company)
    {
        return $company->storage;
    }

    public function buyStorage(Request $request) {
        $user = Auth::user();
        $amount = $request->input('amount');
        $PRICE = 250;

        if (self::getAffiliation($user) == -1)
            return redirect('dashboard')->with('fail', 'You are not part of a company.');

        $company = Company::where('id', self::getAffiliation($user))->get()->first();

        $options = self::getOptions(self::getAffiliation($user));
        if (!self::hasRights($user, $options->expand))
            return redirect('expand')->with('fail', 'You do not have permission to do that.');

        if ($amount < 1) {
            return redirect('expand')->with('fail', 'Invalid amount.');
        }

        $total = $PRICE * $amount;

        if ($company->cash < $total) {
            return redirect('expand')->with('fail', 'The company does not have enough cash to buy that much storage.');
        }

        $company->storage += $amount;
        $company->cash -= $total;
        $company->save();

        return redirect('expand')->with('success', 'Bought '.number_format($amount).' storage for $'.number_format($total).'.');
    }

    public function expand() {

        $user = Auth::user();

        if (CompanyController::getAffiliation($user) == -1) {
            return $this->companyCreate();
        }

        $cid = CompanyController::getAffiliation($user);
        $company = Company::where('id', $cid)->get()->first();
        $names = array();
        $types = 6;

        if (!self::hasRights($user, self::getOptions($cid)->expand)) {
            return redirect('companydashboard')->with('fail', 'You do not have permission to view the expand page.');
        }

        for ($i = 0; $i < $types; $i++) {
            $names[$i] = FactoryController::getTypeName($i);
        }

        $factories = Factory::where('company', $cid)->get();

        return view('expand', array(
            "user" =>$user,
            "names" => $names,
            "factories" => $factories,
            "company" => $company
        ));
    }

    public static function getLeaderboardRank($id)
    {
        $i = 0;
        foreach (Company::all()->sortByDesc('level') as $c) {
            $i++;
            if ($c->id == $id) {
                return $i;
            }
        }
    }

}
