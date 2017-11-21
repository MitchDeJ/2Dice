<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserStock extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user', 'stock', 'amount'
    ];

    protected $table = 'userstocks';

}
