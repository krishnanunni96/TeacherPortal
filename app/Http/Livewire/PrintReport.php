<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use Livewire\Component;

class PrintReport extends Component
{
    public $customers;

    public function mount($date1,$date2){
        $this->customers=Customer::whereBetween('created_at', [$date1, $date2])->get();                            
    }

    public function render()
    {
        return view('livewire.print-report')->layout('layouts.print');
    }
}
