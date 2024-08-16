<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\OrderPayments;
use App\Models\RazorpayPayments;
use Carbon\Carbon;
use Livewire\Component;

class CustomerPayment extends Component
{
    public $orders, $amount_sum, $order, $balance = 0;
    public $paid_amount, $payment_type, $payments, $customers, $order_amount = 0;
    public $payment_id, $flag;

    protected $listeners = ['failedTransaction', 'successTransaction'];

    public function render()
    {
        return view('livewire.customer-payment');
    }

    public function mount($id)
    {
        $this->order_amount = 0;
        $this->payment_type = 1;
        $this->balance = 0;
        $this->amount_sum = 0;
        $this->resetErrorBag();
        $this->order = Order::where('customer_id', $id)->oldest()->get();
        $this->payments = OrderPayments::where('customer_id', $id)->get();
        foreach ($this->payments as $key => $item) {
            $this->amount_sum += $item->paid_amount;
        }
        foreach ($this->order as $data) {
            $this->order_amount += $data->order_amount;
        }
        $this->balance = $this->order_amount - $this->amount_sum;
    }

    public function updated($paid_amount)
    {
        $this->validateOnly($paid_amount, [
            'paid_amount' => 'required|numeric'
        ]);
        if (($this->balance != 0) && ($this->paid_amount >= 0) && ($this->paid_amount <= $this->balance)) {
            $this->flag = true;
        } else {
            $this->flag = false;
            $this->addError('paid_amount', 'Enter value between 0 & ' . $this->balance);
        }
    }

    public function failedTransaction()
    {
        $this->dispatchBrowserEvent('alert', [
            'type' => 'error',
            'message' => 'Transaction failed!'
        ]);
    }

    public function successTransaction($data)
    {
        $this->payment_id = $data;
        $this->save();
    }

    public function saveWithRazorpay()
    {
        $this->validate([
            'paid_amount' => 'required'
        ]);

        foreach ($this->order as $item) {
            $data = [
                'amount' => $this->paid_amount,
                'mobile' => $item->customer->mobile ?? "9876543210",
                'email' => $item->customer->email ?? "user@gmail.com",
            ];
            $this->emit('razorpay', $data);
        }
    }

    public function save()
    {
        if ($this->flag) 
        {
            foreach ($this->order as $item) {
                if ($item->balance != 0 && $this->paid_amount > 0) {
                    if ($this->paid_amount >= $item->balance) {
                        $item->paid_amount += $item->balance;
                        $amount_paid = $item->balance;
                        $this->paid_amount -= $item->balance;
                        $item->balance = $item->order_amount - $item->paid_amount;
                    } elseif ($this->paid_amount < $item->balance) {
                        $item->paid_amount += $this->paid_amount;
                        $amount_paid = $this->paid_amount;
                        $item->balance = $item->order_amount - $item->paid_amount;
                        $this->paid_amount = null;
                    }

                    $payments = new OrderPayments();
                    $payments->order_id = $item->id;
                    $payments->customer_id = $item->customer_id;

                        $payments->payment_id = $this->payment_id;
                    
                    $payments->date = Carbon::today()->toDateString();
                    $payments->order_amount = $item->order_amount;
                    $payments->paid_amount = $amount_paid;
                    $payments->payment_type = $this->payment_type;
                    $payments->save();
                    $item->save();
                }
            }

            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'message' => 'Payment completed successfully'
            ]);
            $this->redirect('/payments');
        }
    }
}
