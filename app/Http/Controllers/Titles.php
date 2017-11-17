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
                return "Completionist ";
            case 1:
                return "Cleaned ";
            case 2:
                return "Businessman ";
            case 3:
                return "Traveller ";
            case 4:
                return "Wealthy ";
            case 5:
                return "Gambler ";
            case 6:
                return "Addict ";
            case 7:
                return "The Insane ";
            case 8:
                return "Risky ";
            case 9:
                return "High Roller ";
            case 10:
                return "Prestiged ";
            case 11:
                return "Exchanger ";
            case 12:
                return "Powerful ";
            case 13:
                return "Investor ";
            case 14:
                return "Lucky ";
            case 15:
                return "VIP ";
            case 16:
                return "#1 ";
            case 17:
                return "Overtaker ";
        }
    }

    public static function getTitleColor($titleid)
    {
        $titleid = (int)$titleid;
        switch ($titleid) {
            case -1:
                return "<p style='color:'></p>";
            case 0:
                return "goldenrod";
            case 1:
                return "red";
            case 2:
                return "cornflowerblue";
            case 3:
                return "darkgreen";
            case 4:
                return "darkorange";
            case 5:
                return "mediumpurple";
            case 6:
                return "lightcoral";
            case 7:
                return "darkorange";
            case 8:
                return "darkred";
            case 9:
                return "orangered";
            case 10:
                return "darkcyan";
            case 11:
                return "black";
            case 12:
                return "darkred";
            case 13:
                return "darkslategray";
            case 14:
                return "green";
            case 15:
                return "grey";
            case 16:
                return "blue";
            case 17:
                return "darkred";
            default:
                return "black";
        }
    }

    public static function getTitleDesc($titleid)
    {
        $titleid = (int)$titleid;
        switch ($titleid) {
            case -1:
                return "";
            case 0:
                return "This title can be unlocked when you have all other titles unlocked.";
            case 1:
                return "This title can be unlocked when your current balance is $0.";
            case 2:
                return "This title can be unlocked when you are part of a company.";
            case 3:
                return "This title will be unlocked when you travel to a different country.";
            case 4:
                return "This title can be bought for $5,000,000.";
            case 5:
                return "This title can be unlocked if you have a total of 100 or more bets.";
            case 6:
                return "This title can be unlocked if you have a total of 1000 or more bets.";
            case 7:
                return "This title can be unlocked if you have a total of 2500 or more bets.";
            case 8:
                return "This title can be unlocked if your highest bet is at least $1,000,000.";
            case 9:
                return "This title can be unlocked if your highest bet is at least $10,000,000.";
            case 10:
                return "This title can be unlocked if you have reached the fifth prestige.";
            case 11:
                return "This title will be unlocked whenever you collect a completed offer on the marketplace.";
            case 12:
                return "This title can be unlocked when you reach 500,000 power.";
            case 13:
                return "This title can be unlocked when you have bought the maximum amount of stock of one company.";
            case 14:
                return "This title will be unlocked whenever you bet and land green on the roulette.";
            case 15:
                return "This title can be unlocked if you are currently a VIP. (donation or prestige points both work).";
            case 16:
                return "This title can be unlocked if your current rank is #1. <strong>[Not required for Completionist]</strong>";
            case 17:
                return "This title will be unlocked when you take over an object, by winning more than it’s bank is currently holding. 
                <strong>[Not required for Completionist]</strong>";

            default:
                return "description";
        }
    }
}
