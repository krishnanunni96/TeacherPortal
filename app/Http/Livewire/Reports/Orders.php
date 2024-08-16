<?php

namespace App\Http\Livewire\Reports;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\PDF;
use Carbon\Carbon;
use Livewire\Component;

class Orders extends Component
{
    public $date1, $date2, $orders, $total_order_amount=0, $status_filter=0;

    public function mount(){
        $this->date2=Carbon::today()->toDateString();
        $this->date1=Carbon::today()->subMonth()->toDateString();
    }
    
    public function render()
    {
        $query = Order::latest();
        if ($this->date1 != '') {
            if ($this->date2 == '') {
                $this->date2 = Carbon::today()->toDateString();
                $query->whereBetween('date_of_order', [$this->date1, $this->date2]);
            } else {
                $query->whereBetween('date_of_order', [$this->date1, $this->date2]);
            }
        }
        if($this->status_filter){                                   
            $query->where('status',$this->status_filter);
        }
        $this->orders = $query->get();

        return view('livewire.reports.orders');
    }

    public function downloadPDF()
    {
        $orders = Order::whereBetween('date_of_order',[$this->date1,$this->date2])->get();
        if ($orders) {
            $pdf = PDF::loadView('order_report_pdf', compact('orders'))->output();
            return response()->streamDownload(function () use ($pdf) {
                print($pdf);
            }, "Order_report.pdf");
        }
    }
}
