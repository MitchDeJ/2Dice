<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cooldown extends Model
{
    protected $table = 'cooldowns';

    protected $fillable = [
        'id', 'user', 'type', 'end'
    ];
}
