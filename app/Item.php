<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    public function itemCategory()
    {
        return $this->belongsTo('App\ItemCategory','category','id');
    }

}
