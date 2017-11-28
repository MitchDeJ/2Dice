<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collab extends Model
{
    protected $table = 'collabs';

    protected $fillable = [
        'id', 'user'
    ];
}
