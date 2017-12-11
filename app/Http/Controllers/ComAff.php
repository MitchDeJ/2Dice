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
}
