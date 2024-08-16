<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\OrderDetails;
use Livewire\Component;

class OrderStatusScreenComponent extends Component
{
    public $pending,$processing,$ready_to_deliver;
    public $service1, $service2, $service3;
    public $element_id, $status, $order;

    public function statusChange($element_id,$status){                                         
        $this->order=Order::find($element_id);
        if($status=="pending"){
            $this->order->status=1;
            $this->order->save();
        } elseif($status=="processing"){
            $this->order->status=2;
            $this->order->save();
        } elseif($status=="ready"){
            $this->order->status=3;
            $this->order->save();
        } else {}
    }

    public function render()
    {
        $this->pending=Order::where('status',1)->get();
        $this->service1=null;
            foreach($this->pending as $data){
                    $this->service1=OrderDetails::where('order_id',$data->id)->get();
                }                                                                                               

        $this->processing=Order::where('status',2)->get();
        $this->service2=null;
        foreach($this->processing as $data){
                    $this->service2=OrderDetails::where('order_id',$data->id)->get();
                }                                                                                                            

        $this->ready_to_deliver=Order::where('status',3)->get();
        $this->service3=null;
        foreach($this->ready_to_deliver as $data){
                    $this->service3=OrderDetails::where('order_id',$data->id)->get();
                }   
        return view('livewire.order.order-status-screen-component');
    }
    
}
