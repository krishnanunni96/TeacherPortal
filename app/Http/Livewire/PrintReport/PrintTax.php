<?php

namespace App\Http\Livewire\PrintReport;

use App\Models\Expense;
use App\Models\Order;
use App\Models\Purchase;
use Livewire\Component;

class PrintTax extends Component
{
    public $reports, $filter;
    public $total_amount1, $total_tax_amount1, $total_amount3, $total_tax_amount3, $total_amount2, $total_tax_amount2, $tax_amt=0;


    public function mount($date1, $date2, $filter)
    {
        $query = Order::whereBetween('date_of_order', [$date1, $date2]);
        $query2 = Expense::whereBetween('date', [$date1, $date2]);
        $query3 = Purchase::whereBetween('purchase_date', [$date1, $date2]);

        if ($filter == 1) {
            $this->reports = $query->get();
        } elseif ($filter == 2) {
            $this->reports = $query2->get();
        } else {
            $this->reports = $query3->get();
        }
    }

    public function render()
    {
        return view('livewire.print-report.print-tax')->layout('layouts.print');
    }
}
