<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderPayments;
use Carbon\Carbon;
use Livewire\Component;

class Payments extends Component
{
    public $search, $status, $orders, $amount_sum, $order;
    public $payment_type, $payments, $customers;

    public function mount()
    {
        $this->payment_type = 1;
        $this->customers = Customer::latest()->get();
        $this->payments = OrderPayments::latest()->get();
    }

    public function render()
    {
        $query = Order::oldest();
        if ($this->search != '') {
            $query->where('order_no', 'like', '%' . $this->search . '%');
            $query->orWhere('order_amount', 'like', '%' . $this->search . '%');
        }
        if ($this->status) {
            $query->where('status', $this->status); 
        }
        $this->orders = $query->get();
        return view('livewire.payments');
    }

}
