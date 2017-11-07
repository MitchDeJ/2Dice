<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarketOffer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'creator', 'creatortype', 'offertype', 'item', 'price', 'amount', 'completed', 'collected', 'cash', 'cancelled'
    ];

    protected $table = 'marketoffers';
}
