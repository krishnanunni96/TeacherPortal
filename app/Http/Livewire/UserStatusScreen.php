<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use Livewire\Component;

class UserStatusScreen extends Component
{
    public $inactive, $active;
    public $customer;

    public function render()
    {
        $this->inactive = Customer::where('is_active', 0)->get();
        $this->active = Customer::where('is_active', 1)->get();
        
        return view('livewire.user-status-screen');
    }

    public function isActiveFn($id, $status)
    {
        $this->customer = Customer::find($id);
        if ($status == "inactive") {
            $this->customer->is_active = 0;
            $this->customer->save();
        } 
        elseif ($status == "active") {
            $this->customer->is_active = 1;
            $this->customer->save();
        } 
        else {
        }
    }
}
