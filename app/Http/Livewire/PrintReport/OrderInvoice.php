<?php

namespace App\Http\Livewire\PrintReport;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderAddons_2;
use App\Models\OrderDetails;
use Livewire\Component;

class OrderInvoice extends Component
{
    public $order, $order_details, $customer_details, $addon_sum, $gross_total;

    public function mount($id){
        $this->order = Order::find($id);
        $this->order_details = OrderDetails::where('order_id', $id)->get();
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

    public function render()
    {
        return view('livewire.print-report.order-invoice')->layout('layouts.invoice');
    }
}
