<?php

namespace App\Http\Livewire\Reports;

use App\Models\Expense;
use Carbon\Carbon;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\PDF;

class Expenses extends Component
{
    public $date1 = '', $date2 = '', $expenses, $total_taxamount = 0;

    public function mount(){
        $this->date2=Carbon::today()->toDateString();
        $this->date1=Carbon::today()->subMonth()->toDateString();
    }

    public function render()
    {
        $query = Expense::latest();
        if ($this->date1 != '') {
            // $this->date1 = Carbon::parse($this->date1)->toDateString();         
            if ($this->date2 == '') {
                $this->date2 = Carbon::today()->toDateString();
                $query->whereBetween('date', [$this->date1, $this->date2]);
            } else {
                $this->date2 = Carbon::parse($this->date2)->toDateString();
                $query->whereBetween('date', [$this->date1, $this->date2]);
            }
        }
        $this->expenses = $query->get();
        return view('livewire.reports.expenses');
    }

    public function downloadPDF()
    {
        $expense = Expense::whereBetween('date',[$this->date1,$this->date2])->get();
        if ($expense) {
            $pdf = PDF::loadView('expense_report_pdf', compact('expense'))->output();
            return response()->streamDownload(function () use ($pdf) {
                print($pdf);
            }, "Expense_report.pdf");
        }
    }
}
