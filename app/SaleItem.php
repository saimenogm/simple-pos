<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    //

    public $table = 'sale_items';
    protected $fillable = [
        'uom', 'uod', 'duration','dosage'
    ];

    public function sale()
    {
        return $this->belongsTo('App\Sale','sale_id','id');
    }
}
