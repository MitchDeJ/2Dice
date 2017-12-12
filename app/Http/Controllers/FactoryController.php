<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public static function isProcessType($type) {
        switch ($type) {
            case 3: // Sawmill
            case 4: // Brickworks
            case 5: // Refinery
                return true;
            default:
                return false;
        }
    }

    public static function getTypeName($type) {
        switch($type) {
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

    public static function validType($type) {
        if (self::getTypeName($type) == "")
            return false;

        return true;
    }
}
