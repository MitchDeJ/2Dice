<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ban extends Model
{
    protected $table = 'bans';

    protected $fillable = [
        'id', 'user', 'reason'
    ];
}
