<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Factory;
use Auth;
use App\Company;


class FactoryController extends Controller
{

    public static function isGatherType($type)
    {
        switch ($type) {
            case 0: // Lumberyard
            case 1: // Quarry
            case 2: // Oil rig
                return true;
            default:
                return false;
        }
    }

    public static function isProcessType($type)
    {
        switch ($type) {
            case 3: // Sawmill
            case 4: // Brickworks
            case 5: // Refinery
                return true;
            default:
                return false;
        }
    }

    public static function getTypeName($type)
    {
        switch ($type) {
            case 0:
                return "Lumberyard";
            case 1:
                return "Quarry";
            case 2:
                return "Oil rig";
            case 3:
                return "Sawmill";
            case 4:
                return "Brickworks";
            case 5:
                return "Refinery";
            default:
                return "";
        }
    }

    public static function validType($type)
    {
        if (self::getTypeName($type) == "")
            return false;

        return true;
    }

    public static function getUnitsPerHour($level)
    {
        $val = 500;

        for ($i = 1; $i < $level; $i++) {
            $val *= 1.05;
        }

        return floor($val);
    }

    public static function getUpgradeCashCost($level)
    {
        $val = 450000;

        for ($i = 1; $i < $level; $i++) {
            $val *= 1.075;
        }

        return floor($val);
    }

    public static function getUpgradeResourceCost($level)
    {
        $val = 3000;

        for ($i = 1; $i < $level; $i++) {
            $val *= 1.075;
        }

        return floor($val);
    }

    public static function getRequiredResource($type)
    {
        switch ($type) {
            case 3:
                return 0;
            case 4:
                return 1;
            case 5:
                return 2;
            default:
                return "";
        }
    }

    public static function getUpgradeResource($type)
    {
        switch ($type) {
            case 0:
                return 1;
            case 1:
                return 2;
            case 2:
                return 0;
            case 3:
                return 5;
            case 4:
                return 6;
            case 5:
                return 4;
            default:
                return -1;
        }
    }

    public static function getResultResource($type)
    {
        switch ($type) {
            case 0:
                return 0;
            case 1:
                return 1;
            case 2:
                return 2;
            case 3:
                return 4;
            case 4:
                return 5;
            case 5:
                return 6;
            default:
                return -1;
        }
    }

    public static function upgrade(Request $request)
    {
        $user = Auth::user();
        $fid = $request->input('fid');

        if (CompanyController::getAffiliation($user) == -1)
            return redirect('dashboard')->with('fail', 'You are not part of a company.');

        $company = Company::where('id', CompanyController::getAffiliation($user))->get()->first();

        $options = CompanyController::getOptions($company->id);
        if (!CompanyController::hasRights($user, $options->expand))
            return redirect('companydashboard')->with('fail', 'You do not have permission to do that.');

        $factories = Factory::where('company', $company->id)->get();
        $factory = null;


        foreach ($factories as $f) {
            if ($f->id == $fid) {
                $factory = $f;
            }
        }

        if ($factory == null)
            return redirect('expand')->with('fail', 'Invalid factory.');

        $redirect = 'factory/'.$factory->id;

        $cCost = self::getUpgradeCashCost($factory->level);
        $rCost = self::getUpgradeResourceCost($factory->level);
        $item = self::getUpgradeResource($factory->type);

        if ($company->cash < $cCost)
            return redirect($redirect)->with('fail', 'The company does not have enough cash to upgrade this factory.');
        if (!MarketplaceController::hasItem($company, $item, $rCost))
            return redirect($redirect)->with('fail', 'The company does not have enough 
            ' . strtolower(MarketPlaceController::getItemNames()[$item]) . ' to upgrade this factory.');

        //upgrading
        MarketplaceController::removeItem($company, $item, $rCost);
        $company->cash -= $cCost;
        $factory->level += 1;
        $company->level += 1;
        $company->save();
        $factory->save();
        return redirect($redirect)->with('success', self::getTypeName($factory->type) . ' upgraded to level ' . $factory->level . '!');
    }

    public function remove(Request $request)
    {

        $user = Auth::user();
        $fid = $request->input('fid');
        $confirm = $request->input('confirm');

        if (CompanyController::getAffiliation($user) == -1)
            return redirect('dashboard')->with('fail', 'You are not part of a company.');

        $company = Company::where('id', CompanyController::getAffiliation($user))->get()->first();
        $redirect = 'expand';

        $options = CompanyController::getOptions($company->id);
        if (!CompanyController::hasRights($user, $options->expand))
            return redirect('expand')->with('fail', 'You do not have permission to do that.');

        $factories = Factory::where('company', $company->id)->get();
        $factory = null;


        foreach ($factories as $f) {
            if ($f->id == $fid) {
                $factory = $f;
            }
        }

        if ($factory == null)
            return redirect($redirect)->with('fail', 'Invalid factory.');

        if ($confirm != 1)
            return redirect('factory/'.$factory->id)->with('fail', 'You have to confirm that you want to remove this factory.');

        //removing

        $company->level -= $factory->level;
        $company->save();
        $factory->delete();
        return redirect($redirect)->with('success', self::getTypeName($factory->type) . ' removed.');
    }

    public static function getFactoryLimit()
    {
        return 4;
    }

    public static function getTypeLimit()
    {
        return 2;
    }

    public static function getBuildCost($count)
    {
        //count= how many you currently own
        $pointcash = 3000000; //how much cash you get off one prestige point
        switch ($count) {
            case 0:
                return 500000;
            case 1:
                return $pointcash * 0.5;
            case 2:
                return $pointcash * 1;
            case 3:
                return $pointcash * 2;
        }
    }

    public static function getBuildReq($count)
    {
        //count= how many you currently own
        $pointpower = 5000000; //how much power you get off one prestige point
        switch ($count) {
            case 0:
                return 0;
            case 1:
                return ($pointpower * 1) /100;
            case 2:
                return ($pointpower * 2) /100;
            case 3:
                return ($pointpower * 4) /100;
        }
    }

    public static function build(Request $request)
    {
        $user = Auth::user();
        $type = $request->input('type');

        if (CompanyController::getAffiliation($user) == -1)
            return redirect('dashboard')->with('fail', 'You are not part of a company.');

        $company = Company::where('id', CompanyController::getAffiliation($user))->get()->first();
        $options = CompanyController::getOptions($company->id);
        if (!CompanyController::hasRights($user, $options->expand))
            return redirect('companydashboard')->with('fail', 'You do not have permission to do that.');

        $redirect = 'build';


        if (!self::validType($type))
            return redirect($redirect)->with('fail', 'Invalid factory type');

        $factories = Factory::where('company', $company->id)->get();

        if (count($factories) == self::getFactoryLimit())
            return redirect($redirect)->with('fail', 'The company has reached the limit of ' . self::getFactoryLimit() . ' factories.');

        $gather = 0;
        $process = 0;
        $hasType = false;

        foreach ($factories as $f) {
            if (self::isGatherType($f->type))
                $gather++;
            if (self::isProcessType($f->type))
                $process++;
            if ($f->type == $type)
                $hasType = true;
        }

        if ($hasType)
            return redirect($redirect)->with('fail', 'You can not build a factory type more than once.');

        if (self::isGatherType($type)) {
            if ($gather == self::getTypeLimit())
                return redirect($redirect)->with('fail', 'The company has reached the limit of ' . self::getTypeLimit() . ' gathering factories.');
        }

        if (self::isProcessType($type)) {
            if ($process == self::getTypeLimit())
                return redirect($redirect)->with('fail', 'The company has reached the limit of ' . self::getTypeLimit() . ' processing factories.');
        }

        //checking power/cash req

        if ($company->cash < self::getBuildCost(count($factories)))
            return redirect($redirect)->with('fail', 'The company does not have enough cash to build a factory.');

        $power = 0;
        $members = CompanyController::getCompanyMembers($company->id);

        foreach ($members as $m) {
            $power += $m->power;
        }

        if ($power < self::getBuildReq(count($factories)))
            return redirect($redirect)->with('fail', 'The company does not have the required power to build a factory.');

        //building
        $company->cash -= self::getBuildCost(count($factories));
        $company->level += 1;
        $company->save();

        Factory::create([
            'company' => $company->id,
            'type' => $type
        ]);

        return redirect('expand')->with('success', self::getTypeName($type).' built.');
    }

    public function buildView() {

        $user = Auth::user();

        if (CompanyController::getAffiliation($user) == -1) {
            return $this->companyCreate();
        }

        $cid = CompanyController::getAffiliation($user);
        $company = Company::where('id', $cid)->get()->first();
        $count = Factory::where('company', $cid)->get()->count();

        if ($count == self::getFactoryLimit())
            return redirect('expand')->with('fail', 'The company has reached the limit of ' . self::getFactoryLimit() . ' factories.');

        $cashreq = self::getBuildCost($count);
        $powerreq = self::getBuildReq($count);

        $members = CompanyController::getCompanyMembers($company->id);

        $power = 0;
        foreach ($members as $member) {
            $power += $member->power;
        }

        $hascash = ($company->cash >= $cashreq);
        $haspower = ($power >= $powerreq);

        $factories = array();
        $types = 6; //

        for ($i = 0; $i < $types; $i++) {
            $factories[$i] = FactoryController::getTypeName($i);
        }

        return view('build', array(
            "user" =>$user,
            'cashreq' => $cashreq,
            'powerreq'  => $powerreq,
            'hascash' => $hascash,
            'haspower' => $haspower,
            'factories' => $factories
        ));
    }

    public function factoryPage($id)
    {
        $factory = Factory::where("id", $id)->get();

        if ($factory->count() == 0)
            return redirect("expand");

        $factory = $factory->first();

        $cid = CompanyController::getAffiliation(Auth::user());

        if ($factory->company != $cid)
            return redirect('expand');

        if ($cid == -1)
            return redirect('dashboard');

        $company = Company::where('id', $cid)->get()->first();

        $cashreq = self::getUpgradeCashCost($factory->level);
        $resourcereq = self::getUpgradeResourceCost($factory->level);

        $hascash = ($company->cash >= $cashreq);
        $hasresources = (MarketplaceController::hasItem($company, self::getUpgradeResource($factory->type), $resourcereq));

        $typename = self::getTypeName($factory->type);
        $resource = MarketplaceController::getItemNames()[self::getUpgradeResource($factory->type)];
        $result = MarketplaceController::getItemNames()[self::getResultResource($factory->type)];

        $action = "";

        if (self::isGatherType($factory->type))
            $action = "gathers";

        if (self::isProcessType($factory->type))
            $action = "produces";

        $units = self::getUnitsPerHour($factory->level);

        return view('factory', [
            'factory' => $factory,
            'cashreq' => $cashreq,
            'resourcereq' => $resourcereq,
            'hascash' => $hascash,
            'hasresources' => $hasresources,
            'typename' => $typename,
            'resource' => $resource,
            'action' => $action,
            'units' => $units,
            'result' => $result
        ]);
    }
}
