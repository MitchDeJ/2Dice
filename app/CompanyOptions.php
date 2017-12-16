<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyOptions extends Model
{
    protected $table = 'companyoptions';

    protected $fillable = [
        'id', 'company', 'editprofile', 'makeoffers', 'viewoffers', 'handlerequests', 'setroles', 'quicksell', 'salary', 'expand'
    ];
}
