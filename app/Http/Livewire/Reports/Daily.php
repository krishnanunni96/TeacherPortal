<?php

namespace App\Http\Livewire\Reports;

use App\Models\Expense;
use App\Models\Order;
use App\Models\OrderPayments;
use Carbon\Carbon;
use Livewire\Component;

class Daily extends Component
{
    public $orders, $expenses, $order_payments, $date, $total_sales, $total_payment, $total_expense;
    public $new_orders, $orders_delivered;

    public function mount()
    {
        $this->date = Carbon::today()->toDateString();
    }

    public function render()
    {
        if ($this->date) {
            $this->orders = Order::where('date_of_order', $this->date)->get();
            $this->new_orders = count($this->orders);
            $this->orders_delivered = count($this->orders->where('status', 4));
            $this->total_sales=0;
            foreach ($this->orders as $item) {
                $this->total_sales += $item->order_amount;
            }
            
            $this->order_payments = OrderPayments::where('date', $this->date)->get(); 
            $this->total_payment=0;       
            foreach ($this->order_payments as $item) {
                $this->total_payment += $item->paid_amount;
            }

            $this->expenses = Expense::where('date', $this->date)->get();
            $this->total_expense=0;
            foreach ($this->expenses as $item) {
                $this->total_expense += $item->amount;
            }
        }
        return view('livewire.reports.daily');
    }
}
