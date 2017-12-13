<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Facade;
use App\User;

class ComAff extends Facade //short for CompanyAffiliation
{
    public static function getAffiliation(User $user) {
        return CompanyController::getAffiliation($user);
    }

    public static function getRights(User $user) {
        return CompanyController::getRights($user);
    }

    public static function getRole($rights) {
        switch ($rights) {
            case 0:
                return "Member";
            case 1:
                return "Moderator";
            case 2:
                return "Admin";
            case 3:
                return "Owner";
            default:
                return "";
        }
    }

    public static function getOption($cid, $option) {
        $options = CompanyController::getOptions($cid);

        switch($option) {
            case "editprofile":
                return $options->editprofile;
            case "makeoffers":
                return $options->makeoffers;
            case "viewoffers":
                return $options->viewoffers;
            case "handlerequests":
                return $options->handlerequests;
            case "setroles":
                return $options->setroles;
            case "quicksell":
                return $options->quicksell;
            case "salary":
                return $options->salary;
            default:
                return -1;
        }
    }
}
