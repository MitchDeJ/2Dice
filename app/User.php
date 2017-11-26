<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function isStarter($id) {
        $starter = StartPeriod::where('user', $id)->get()->count();

        if ($starter == 0) {
            return false;
        }

        if ($starter == 1) {
            $starter = StartPeriod::where('user', $id)->get()->first();
            if ($starter->end > time()) {
                return true;
            } else {
                $starter->delete();
                return false;
            }
        }
    }

    public static function onCooldown(User $user, $type) {

        $cd = Cooldown::where('user', $user->id)->where('type', $type)->get()->count();

        if ($cd  == 0) {
            return false;
        }

        if ($cd == 1) {
            $cd = Cooldown::where('user', $user->id)->where('type', $type)->get()->first();
            if ($cd->end > time()) {
                return true;
            } else {
                $cd->delete();
                return false;
            }
        }
    }

    public static function addCooldown(User $user, $type, $length) {
        $cdc = Cooldown::where('user', $user->id)->where('type', $type)->get()->count();
        //adding to another cooldown
        if ($cdc == 1) {
            $cd = Cooldown::where('user', $user->id)->where('type', $type)->get()->first();
            $cd->end += $length;
            $cd->save();
        } else if ($cdc == 0) { //new cooldown
            Cooldown::create([
                'user' => $user->id,
                'type' => $type,
                'end' => time()+$length,
            ]);
        }
    }
}
