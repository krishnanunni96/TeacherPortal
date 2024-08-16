<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\OrderDetails;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public $orders, $search, $filter, $order_details;
    public $pending, $processing, $ready_to_deliver, $delivered, $returned;
    public $date;
    public $orders_2, $array = [], $json_data;

    public function render()
    {
        $this->date = Carbon::today()->toDateString();
        $query = Order::where('date_of_delivery', $this->date);
        if ($this->search != '') {
            $query->where('order_no', 'like', '%' . $this->search . '%');
        }
        if ($this->filter) {
            $query->where('status', $this->filter);
        }
        $this->orders = $query->get();
        foreach ($this->orders as $item) {
            $this->order_details = OrderDetails::where('order_id', $item->id)->get();
        }

        $this->pending = Order::where('status', 1)->get()->count();
        $this->processing = Order::where('status', 2)->get()->count();
        $this->ready_to_deliver = Order::where('status', 3)->get()->count();
        $this->delivered = Order::where('status', 4)->get()->count();
        $this->returned = Order::where('status', 5)->get()->count();

        array_push($this->array, [
            $this->pending,
            $this->processing,
            $this->ready_to_deliver,
            $this->delivered,
            $this->returned
        ]);
        $this->json_data = json_encode($this->array);                   

        return view('livewire.dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Logged out');
    }
}
