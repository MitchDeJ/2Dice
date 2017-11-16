<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Facade;

class Titles extends Facade
{
    public static function getTitle($titleid)
    {
        $titleid = (int)$titleid;
        switch ($titleid) {
            case -1:
                return "";
            case 0:
                return "TestTitle ";
        }
    }

    public static function getTitleColor($titleid)
    {
        $titleid = (int)$titleid;
        switch ($titleid) {
            case 0:
                return "green";
            default:
                return "black";
        }
    }

    public static function getTitleDesc($titleid)
    {
        $titleid = (int)$titleid;
        switch ($titleid) {
            case 0:
                return "test";
                break;

            default:
                return "description";
        }
    }
}
