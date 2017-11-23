<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    protected $fillable = [
        'id', 'user', 'type', 'location', 'minprice', 'biduser', 'bid', 'end'
    ];
}
