<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StartPeriod extends Model
{

    protected $table = 'startperiods';

    protected $fillable = [
        'id', 'user', 'end'
    ];
}
