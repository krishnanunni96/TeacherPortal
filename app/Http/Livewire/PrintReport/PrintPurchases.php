<?php

namespace App\Http\Livewire\PrintReport;

use App\Models\Purchase;
use Livewire\Component;

class PrintPurchases extends Component
{
    public $purchases;
    
    public function mount($date1,$date2){
        $this->purchases=Purchase::whereBetween('purchase_date',[$date1,$date2])->get();
    }

    public function render()
    {
        return view('livewire.print-report.print-purchases')->layout('layouts.print');
    }
}
