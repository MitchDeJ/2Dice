<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Affiliation extends Model
{
    protected $table = 'affiliations';

    protected $fillable = [
        'id', 'user', 'company', 'rights'
    ];
}
