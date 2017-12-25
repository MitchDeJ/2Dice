<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IpLog extends Model
{
    protected $table = 'iplogs';
    protected $fillable = [
        'id', 'user', 'ip'
    ];
}
