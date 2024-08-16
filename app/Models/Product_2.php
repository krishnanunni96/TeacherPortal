<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_2 extends Model
{
    use HasFactory;

    public function stock(){
        return $this->belongsTo(Stock::class,'stock_id','id');
    }
}
