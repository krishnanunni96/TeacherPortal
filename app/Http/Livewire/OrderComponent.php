<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\OrderPayments;
use Livewire\Component;

class OrderComponent extends Component
{
    public $orders, $search, $status, $order, $payments, $amount_paid, $payment_type, $flag=false, $balance, $amount_sum, $bal;

    public function updated($amount_paid)
    {
        $this->validateOnly($amount_paid, [
            'amount_paid' => 'required|numeric'
        ]);
        if (($this->balance != 0) && ($this->amount_paid >= 0) && ($this->amount_paid <= $this->balance)) {
            $this->flag=true;
        }    
        else{
            $this->flag=false;
            $this->addError('amount_paid','Enter value between 0 & '.$this->balance);
        }                                               
    }

    public function render()
    {
        $query = Order::latest();
        if ($this->search != '') {
            $query->where('order_no', 'like', '%' . $this->search . '%');
            $query->orWhere('order_amount', 'like', '%' . $this->search . '%');
        }
        if($this->status){
            $query->where('status',$this->status);
        }
        $this->orders = $query->get();
        return view('livewire.order.order-component');
    }

    public function mount(){
            $this->flag=false;
        $this->payment_type=1;
        $this->amount_paid=null;
        $this->payments = OrderPayments::latest()->get();
    }

    public function addPayment($id)
    {                                                                   
        $this->amount_paid=null;
        $this->resetErrorBag();
        $this->order = Order::find($id);
        $this->payments = OrderPayments::where('order_id', $id)->get();
        $this->amount_sum = 0;
        foreach ($this->payments as $item) {
            $this->amount_sum += $item->paid_amount;
        }
        $this->balance = $this->order->order_amount - $this->amount_sum;                         
    }
    
    public function paymentStatus($id)
    {                                                                   
        $amount_sum = 0;
        $order = Order::find($id);
        $payments = OrderPayments::where('order_id', $id)->get();
        foreach ($payments as $item) {
            $amount_sum += $item->paid_amount;
        }
        return $this->bal = $order->order_amount - $amount_sum;                         
    }

    public function save()
    {                           
        if($this->flag){
            $order_payment = new OrderPayments();
            $order_payment->order_id = $this->order->id;
            $order_payment->customer_id = $this->order->customer_id;
            $order_payment->date = Carbon::today()->toDateString();
            $order_payment->paid_amount = $this->amount_paid;
            $order_payment->payment_type = $this->payment_type;
            $order_payment->save();
        }
        $this->emit('closemodal');
        $this->reset();
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Payment of $'.$order_payment->paid_amount.' is successful.'
        ]);
    }
}
