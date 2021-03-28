<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    //

    public function purchase()
    {
        return $this->belongsTo('App\Purchase','purchase_id','id');
    }

}
