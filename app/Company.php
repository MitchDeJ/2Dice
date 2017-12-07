<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    protected $fillable = [
        'id', 'name', 'avatar', 'desc', 'owner', 'location', 'createdat', 'level'
    ];
}
