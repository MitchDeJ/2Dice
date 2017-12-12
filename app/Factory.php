<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factory extends Model
{
    protected $table = 'factories';
    protected $fillable = [
        'id', 'company', 'type', 'efficiency', 'luck'
    ];
}
