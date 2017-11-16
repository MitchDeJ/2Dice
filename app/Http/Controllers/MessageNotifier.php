<?php

namespace App\Http\Controllers;

use Auth;
use App\Message;
use Illuminate\Support\Facades\Facade;

class MessageNotifier extends Facade
{
    public static function getUnread()
    {
        $user = Auth::user();
        $messages= Message::where("to", strtolower($user->name))->where("read", 0)->get();
        return count($messages);
    }
}
