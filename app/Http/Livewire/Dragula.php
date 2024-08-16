<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use Livewire\Component;

class Dragula extends Component
{
    public $customers;

    public function render()
    {
        $this->customers = Customer::all();
        
        return view('livewire.dragula');
    }
}
