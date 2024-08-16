<?php

namespace App\Http\Livewire\PrintReport;

use App\Models\Order;
use Livewire\Component;

class PrintSales extends Component
{
    public $orders;

    public function mount($date1,$date2){
        $this->orders=Order::whereBetween('date_of_order',[$date1,$date2])->get();
    }

    public function render()
    {
        return view('livewire.print-report.print-sales')->layout('layouts.print');
    }
}
