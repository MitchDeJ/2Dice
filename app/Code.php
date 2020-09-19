<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    protected $fillable = [
        'code', 'used', 'user'
    ];

    public $timestamps = false;

}
