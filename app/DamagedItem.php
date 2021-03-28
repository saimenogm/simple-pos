<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DamagedItem extends Model
{
    //

    public function  Damaged()
    {
        return $this->belongsTo('App\Damaged','damaged_id','id');
    }

}
