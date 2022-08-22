<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';
    protected $guarded = [
    	'id'
    ];

    public function item()
    {
    	return $this->hasOne('App\Models\Tryout', 'id', 'item_id');
    }
}
