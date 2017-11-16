<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlackjackTurn extends Model
{
    protected $table = 'blackjackturns';

    protected $fillable = [
        'user', 'location', 'usercardtype', 'usercard', 'cpucardtype', 'cpucard', 'bet', 'stand'
    ];
}
