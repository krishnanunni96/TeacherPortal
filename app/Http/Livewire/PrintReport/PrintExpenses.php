<?php

namespace App\Http\Livewire\PrintReport;

use App\Models\Expense;
use Livewire\Component;

class PrintExpenses extends Component
{
    public $expenses;

    public function mount($date1,$date2){
        $this->expenses=Expense::whereBetween('date', [$date1, $date2])->get();                            
    }

    public function render()
    {
        return view('livewire.print-report.print-expenses')->layout('layouts.print');
    }
}
