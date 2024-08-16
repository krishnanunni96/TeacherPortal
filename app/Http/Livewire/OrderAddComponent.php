<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderAddon;
use App\Models\OrderAddons_2;
use App\Models\OrderDetails;
use App\Models\OrderPayments;
use App\Models\Service;
use App\Models\ServiceType;
use App\Models\ServiceType_2;
use Carbon\Carbon;
use Livewire\Component;

class OrderAddComponent extends Component
{
    public $customer_search, $customer_search_results, $customer, $services, $service_search, $service_types, $service_type_id;
    public $name, $address, $mobile, $tax_number, $email, $is_active, $service_ID, $service_lists, $service_name, $quantity = [], $cart = [], $rate = [];
    public $type_id, $gross_total = 0, $gross_total_2, $taxamnt, $date_of_order, $date_of_delivery, $order_number = "ORD-1";
    public $order_addons, $addon = [], $addon_sum, $discount = 0, $paid_amount, $balance, $payment_type, $remark;
    public $payment_id;

    protected $listeners = ['failedTransaction', 'successTransaction'];

    protected $rules = [
        'rate.*' => 'required',
        'quantity.*' => 'required',
        'discount' => 'required',
        'paid_amount' => 'required'
    ];

    public function updated($quantity)
    {
        $this->validateOnly($quantity);
        $this->calculate_total();
    }

    public function updatedRate($rate)
    {
        $this->validateOnly($rate);
        $this->calculate_total();
    }

    public function updatedDiscount($discount)
    {
        $this->validateOnly($discount);
        $this->grossTotal();
    }

    public function updatedPaidAmount($paid_amount)
    {
        $this->validateOnly($paid_amount);
        $this->balance = $this->gross_total_2 - $this->paid_amount;
    }

    public function updatedAddon($addon)
    {
        $this->addon_sum = array_sum($this->addon);
        $this->validateOnly($addon);
        $this->grossTotal();
        $this->balance = $this->gross_total_2 - $this->paid_amount;
    }

    public function grossTotal()
    {
        if ($this->customer == null) {
            $this->addError('customer_search', 'Customer required');
            return 1;
        }
        if ($this->cart == []) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => 'Cart cannot be empty'
            ]);
        }
        $this->resetErrorBag();
        $this->balance = null;
        $this->payment_type = 1;
        $subtotal = 0;
        $this->gross_total_2 = 0;
        if ($this->discount > 0) {
            $subtotal = ($this->gross_total + $this->addon_sum) - $this->discount;
        } else {
            $subtotal = $this->gross_total + $this->addon_sum;
        }
        $this->taxamnt = ($this->gross_total * 15) / 100;
        $this->gross_total_2 = $subtotal + $this->taxamnt;
        $this->balance = $this->gross_total_2 - $this->paid_amount;
    }

    public function calculate_total()
    {
        $this->gross_total = 0;
        foreach ($this->cart as $key => $data) {
            $this->gross_total += $this->rate[$key] * $this->quantity[$key];
        }
    }

    public function customerSelect($id)
    {
        $this->customer = Customer::find($id);
        $this->customer_search_results = [];
        $this->customer_search = '';
    }

    public function quantityAdd($i)
    {
        $this->quantity[$i]++;
        $this->calculate_total();
    }

    public function quantitySub($i)
    {
        if ($this->quantity[$i] == 1) {
            unset($this->cart[$i]);
            $this->calculate_total();
        } else {
            $this->quantity[$i]--;
            $this->calculate_total();
        }
    }

    public function serviceType($id)
    {
        $this->service_types = ServiceType_2::where('service_id', $id)->get();
        $servicetype = ServiceType_2::where('service_id', $id)->first();
        if ($servicetype) {
            $this->service_type_id = $servicetype->id;
        }
    }

    public function servicesAdd($service_ID)
    {
        $this->quantity[] = 1;
        $type_name = ServiceType_2::where('id', $this->service_type_id)->value('type_name');
        $this->rate[] = ServiceType_2::where('id', $this->service_type_id)->value('price');
        $this->service_name = Service::where('id', $service_ID)->value('name');
        array_push($this->cart, ['serviceid' => $service_ID, 'service_name' => $this->service_name, 'type_name' => $type_name, 'type_id' => $this->service_type_id]);
        $this->calculate_total();
        $this->emit('closemodal');
    }

    public function resetFn()
    {
        $this->resetErrorBag();
        $this->cart = $this->addon = [];
        $this->rate = $this->quantity = [];
        $this->gross_total_2  = $this->balance = $this->gross_total = 0;
        $this->discount = $this->paid_amount = null;
        $this->date_of_delivery = $this->remark = $this->customer = '';
    }

    public function mount()
    {
        $this->discount = null;
        $this->date_of_order = Carbon::today()->toDateString();
        $this->date_of_delivery = Carbon::today()->toDateString();
        $this->is_active = 1;
        $this->order_addons = OrderAddon::all();
        $orders = Order::latest()->value('id');
        $this->order_number = "ORD-" . ($orders + 1);
    }

    public function render()
    {
        $this->addon_sum = array_sum($this->addon);

        $query = Customer::latest();
        $query2 = Service::latest();
        if ($this->customer_search != '') {
            $query->where('name', 'like', '%' . $this->customer_search . '%');
        }
        if ($this->service_search != '') {
            $query2->where('name', 'like', '%' . $this->service_search . '%');
        }

        $this->customer_search_results = $query->limit(8)->get();
        $this->services = $query2->get();
        return view('livewire.order.order-add-component');
    }

    public function customerAdd()
    {
        $this->validate([
            'name' => 'required|min:3',
            'mobile' => 'required|numeric',
        ]);

        $customer = new Customer();
        $customer->name = $this->name;
        $customer->address = $this->address;
        $customer->mobile = $this->mobile;
        $customer->tax_number = $this->tax_number;
        $customer->email = $this->email;
        $customer->is_active = $this->is_active;
        $customer->save();

        $this->customerSelect($customer->id);
        $this->emit('closemodal');
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Customer added Successfully!'
        ]);
    }

    public function saveWithRazorpay()
    {
            $data = [
                'amount' => $this->paid_amount,
                'phone' => $this->customer->phone ?? "9876543210",
                'email' => $this->customer->email ?? "user@gmail.com",
            ];
            $this->emit('razorpay', $data);
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
        $this->saveAndPrint();
    }

    public function saveAndPrint()
    {
        $this->validate([
            'date_of_delivery' => 'required',
            'paid_amount' => 'required'
        ]);
        if ($this->customer == null) {
            $this->addError('customer_search', 'Customer required');
            return 1;
        }
        if ($this->cart == []) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => 'Cart cannot be empty'
            ]);
        } else {
            $order = new Order();
            $order->customer_id = $this->customer->id;
            $order->order_no = $this->order_number;
            $order->date_of_order = $this->date_of_order;
            $order->date_of_delivery = $this->date_of_delivery;
            $order->order_amount = $this->gross_total_2;
            $order->sub_total = $this->gross_total;
            $order->tax_amount = ($this->gross_total * 15) / 100;
            $order->paid_amount = $this->paid_amount;
            $order->payment_type = $this->payment_type;
            $order->discount = $this->discount;
            $order->remark = $this->remark;
            $order->balance = $this->balance;
            $order->save();

            foreach ($this->cart as $key => $data) {
                $order_details = new OrderDetails();
                $order_details->order_id = $order->id;
                $order_details->service_id = $data['serviceid'];
                $order_details->type_id = $data['type_id'];
                $order_details->rate = $this->rate[$key];
                $order_details->quantity = $this->quantity[$key];
                $order_details->save();
            }

            foreach ($this->addon as $key => $data) {
                if ($data) {
                    $order_addons = new OrderAddons_2();
                    $order_addons->order_id = $order->id;
                    $order_addons->addon_id = $key;
                    $order_addons->save();
                }
            }

            $order_payments = new OrderPayments();
            $order_payments->order_id = $order->id;
            $order_payments->customer_id = $this->customer->id;
            $order_payments->payment_id = $this->payment_id;
            $order_payments->date = $this->date_of_order;
            $order_payments->order_amount = $order->order_amount;
            $order_payments->paid_amount = $this->paid_amount;
            $order_payments->payment_type = $this->payment_type;
            $order_payments->save();

            $this->emit('closemodal');
            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'message' => 'Order added successfully'
            ]);
            return redirect('order');
        }
    }
}
