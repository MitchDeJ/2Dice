<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameObject extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'type', 'location', 'owner', 'cash', 'maxbet', 'profit'
    ];

}
