<?php

namespace App\Http\Livewire\Reports;

use App\Models\Expense;
use App\Models\Order;
use App\Models\Purchase;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\PDF;
use Livewire\Component;

class Tax extends Component
{
    public $reports, $sales, $expense, $purchase, $date1, $date2, $filter;
    public $total_amount1, $total_tax_amount1, $total_amount3, $total_tax_amount3, $total_amount2, $total_tax_amount2, $tax_amt=0;

    public function mount(){
        $this->date2=Carbon::today()->toDateString();
        $this->date1=Carbon::today()->subMonth()->toDateString();
        $this->filter = 1;
    }

    public function render()
    {
        $query = Order::whereBetween('date_of_order', [$this->date1, $this->date2]);
        $query2 = Expense::whereBetween('date', [$this->date1, $this->date2]);
        $query3 = Purchase::whereBetween('purchase_date', [$this->date1, $this->date2]);

        if ($this->filter == 1) {
            $this->reports = $query->get();
        } elseif ($this->filter == 2) {
            $this->reports = $query2->get();
        } else {
            $this->reports = $query3->get();
        }

        return view('livewire.reports.tax');
    }

    public function downloadPDF()
    {
        $query = Order::whereBetween('date_of_order', [$this->date1, $this->date2]);
        $query2 = Expense::whereBetween('date', [$this->date1, $this->date2]);
        $query3 = Purchase::whereBetween('purchase_date', [$this->date1, $this->date2]);
        
        if ($this->filter == 1) {
            $this->reports = $query->get();
        } elseif ($this->filter == 2) {
            $this->reports = $query2->get();
        } else {
            $this->reports = $query3->get();
        }

        if ($this->reports) {
            $pdf = PDF::loadView('tax_report_pdf', ['reports'=>$this->reports, 'filter'=>$this->filter])->output();
            return response()->streamDownload(function () use ($pdf) {
                print($pdf);
            }, "Tax_report.pdf");
        }
    }
}
