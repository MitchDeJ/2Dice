<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\StartPeriod;

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
}
