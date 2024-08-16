<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;

    public function order(){
        return $this->belongsTo(Order::class,'order_id','id');
    }
    public function service(){
        return $this->belongsTo(Service::class,'service_id','id');
    }
    public function service_type_2(){
        return $this->belongsTo(ServiceType_2::class,'type_id','id');
    }
}
