<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class RankController extends Controller
{
    public static function addXp(User $user, $amount) {

        $XP_FOR_LEVEL = 100000;

        $user->xp += $amount;
        if($user->xp >= $XP_FOR_LEVEL) {
            $user->xp -= $XP_FOR_LEVEL;
            if ($user->rank == 10) {
                //the player should prestige now
                $user->rank = 1;
                $user->prestige+=1;
                $user->prestigepoints+=1;
                MessageController::sendSystemMessage($user->name, "You have gained prestige!",
                    "Congratulations! You have reached prestige ".$user->prestige.".
                     Your level has been reset to 1 and you have gained 1 prestige point. Prestige points can be spent in the prestige shop.");
            } else {
                //the player just gained a rank
                $user->rank+=1;
                MessageController::sendSystemMessage($user->name, "You have gained a level!",
                    "Congratulations! You are now level ".$user->rank.".");
            }
        }
        $user->save();
    }
}
