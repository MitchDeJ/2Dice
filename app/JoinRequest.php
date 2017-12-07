<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JoinRequest extends Model
{
    protected $table = 'joinrequests';

    protected $fillable = [
        'id', 'user', 'company'
    ];
}
