<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAddons_2 extends Model
{
    use HasFactory;

    public function addon(){
        return $this->belongsTo(OrderAddon::class,'addon_id','id');
    }

    public function order(){
        return $this->belongsTo(Order::class,'order_id','id');
    }
}
