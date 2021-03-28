<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransferItem extends Model
{
    //

    public function transfer()
    {
    
        return $this->belongsTo('App\Transfer','transfer_id','id');
    
    }

}
