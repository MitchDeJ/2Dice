<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coinflip extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user', 'bet'
    ];
}
