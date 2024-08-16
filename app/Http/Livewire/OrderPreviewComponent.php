<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderAddons_2;
use App\Models\OrderDetails;
use App\Models\OrderPayments;
use Carbon\Carbon;
use Livewire\Component;

class OrderPreviewComponent extends Component
{
    public $order, $order_details, $customer_details, $service_addon, $servide_type, $sub_total = 0, $addon_sum = 0, $gross_total = 0;
    public $status,$balance,$amount_sum,$amount_paid,$flag;

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
        $this->payments = OrderPayments::where('order_id',$this->order->id)->get();                     

        return view('livewire.order.order-preview-component');
    }

    public function mount($id)
    {
        $this->payment_type=1;
        $this->order = Order::find($id);                    
        $this->order_details = OrderDetails::where('order_id', $id)->get();
        $this->payments = OrderPayments::where('order_id', $id)->get();                     
        $this->amount_sum = 0;
        foreach ($this->payments as $item) {
            $this->amount_sum += $item->paid_amount;
        }
        $this->balance = $this->order->order_amount - $this->amount_sum; 
        $this->customer_details = Customer::find($this->order->customer_id);
        $this->service_addon = OrderAddons_2::where('order_id', $id)->get();
        foreach ($this->service_addon as $data) {
            $this->addon_sum += $data->addon->addon_price;
        }
        $this->total();
    }

    public function total()
    {
        $this->gross_total = $this->order->sub_total + $this->addon_sum + $this->order->tax_amount - $this->order->discount;
    }

    public function status($id){       
        if($this->order->status<$id){
            $this->order->status=$id;
            $this->order->save();
            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'message' => 'Order status changed to '.getOrderStatus($this->order->status)
            ]);
        }    else{
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => 'Order status cannot be changed to '.getOrderStatus($id)
            ]);
        } 
    }

    public function addPayment(){
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
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Payment done'
        ]);
    }
}
