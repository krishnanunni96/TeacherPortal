<?php

namespace App\Http\Livewire\PrintReport;

use App\Models\Order;
use Livewire\Component;

class PrintOrders extends Component
{
    public $orders;

    public function mount($date1,$date2,$status){                               
        $orders=Order::whereBetween('date_of_order', [$date1, $date2]);
        if($status){
            $orders->where('status',$status);       
        }
        $this->orders=$orders->get();
    }
    public function render()
    {
        return view('livewire.print-report.print-orders')->layout('layouts.print');
    }
}
