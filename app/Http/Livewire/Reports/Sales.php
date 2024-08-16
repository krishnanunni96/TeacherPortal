<?php

namespace App\Http\Livewire\Reports;

use App\Models\Order;
use Carbon\Carbon;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\PDF;

class Sales extends Component
{
    public $date1, $date2, $orders, $total_sales=0, $total_tax=0;

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
        $this->orders = $query->get();

        return view('livewire.reports.sales');
    }

    public function downloadPDF()
    {
        $orders = Order::whereBetween('date_of_order',[$this->date1,$this->date2])->get();
        if ($orders) {
            $pdf = PDF::loadView('sales_report_pdf', compact('orders'))->output();
            return response()->streamDownload(function () use ($pdf) {
                print($pdf);
            }, "Sales_report.pdf");
        }
    }
}
