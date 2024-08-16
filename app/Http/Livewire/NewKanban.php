<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\OrderDetails;
use Livewire\Component;

class NewKanban extends Component
{
    public $pending,$processing,$ready_to_deliver;
    public $service1, $service2, $service3;
    public $element_id, $order;

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
        $this->processing=Order::where('status',2)->get();
        $this->ready_to_deliver=Order::where('status',3)->get();
 
        return view('livewire.new-kanban')->layout('layouts.login');
    }

}
